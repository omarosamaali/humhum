<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageUser;
use App\Models\MessageReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function create()
    {
        return view('c1he3f.new-message');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('message_files', 'public');
        }

        Message::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'file_path' => $filePath,
            'status' => 'unread',
            // 'type' => 'user_to_admin',
        ]);

        return redirect()->route('c1he3f.messages')->with('success', 'تم إرسال الرسالة بنجاح!');
    }

    public function index()
    {
        $messages = Message::where('user_id', Auth::id())
            ->orWhereHas('replies', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with('user', 'replies.user')
            ->latest()
            ->get();
        return view('c1he3f.messages', compact('messages'));
    }

    // في MessageController.php

    public function show($id)
    {
        // البحث في كلا الجدولين
        $message = Message::find($id);

        if (!$message) {
            $message = MessageUser::find($id);
        }

        // إذا لم توجد الرسالة في أي من الجدولين
        if (!$message) {
            abort(404, 'الرسالة غير موجودة');
        }

        // التحقق من الصلاحية: المستخدم الحالي يجب أن يكون صاحب الرسالة
        if ($message->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بمشاهدة هذه الرسالة.');
        }

        // تحديث حالة الرسالة من unread إلى opened
        if ($message->status === 'unread') {
            $message->update(['status' => 'opened']);
        }

        // تحديث حالة جميع الردود غير المقروءة
        foreach ($message->replies as $reply) {
            if ($reply->status === 'unread' && $reply->user_id !== Auth::id()) {
                $reply->update(['status' => 'read']);
            }
        }

        return view('c1he3f.chat', compact('message'));
    }

    public function reply(Request $request, $id)
    {
        $request->validate([
            'content' => 'required_without_all:file|nullable|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480',
        ]);

        // البحث في كلا الجدولين
        $message = Message::find($id);

        if (!$message) {
            $message = MessageUser::find($id);
        }

        if (!$message) {
            abort(404, 'الرسالة غير موجودة');
        }

        // التحقق من الصلاحية
        if ($message->user_id !== Auth::id()) {
            abort(403, 'غير مصرح لك بالرد على هذه الرسالة.');
        }

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('replies_attachments', 'public');
        }

        if ($request->filled('content') || $request->hasFile('file')) {
            $message->replies()->create([
                'user_id' => Auth::id(),
                'content' => $request->content,
                'file_path' => $filePath,
                'status' => 'unread',
            ]);

            $message->update(['status' => 'replied']);

            Log::info('New Message Reply created by user ID: ' . Auth::id() . ' for message ID: ' . $message->id);

            return back()->with('success', 'تم إرسال ردك بنجاح!');
        }

        return back()->with('error', 'يجب إدخال محتوى أو ملف لإرسال الرد.');
    }

    public function adminIndex()
    {
        $messages = Message::with(['user' => function ($query) {
            $query->withDefault(['name' => 'مستخدم محذوف']);
        }])->latest()->paginate(10);
        $messagesUser = MessageUser::with(['user' => function ($query) {
            $query->withDefault(['name' => 'مستخدم محذوف']);
        }])->latest()->paginate(10);
        return view('admin.messages.index', compact('messages', 'messagesUser'));
    }

    public function adminShow($id)
    {
        // البحث في Message أو MessageUser
        $message = Message::find($id);

        if (!$message) {
            $message = MessageUser::find($id);
        }

        if (!$message) {
            abort(404, 'الرسالة غير موجودة');
        }

        // تحديث حالة الرسالة إلى "مفتوحة" إذا كانت غير مقروءة
        if ($message->status === 'unread') {
            $message->update(['status' => 'opened']);
        }

        // تحديث حالة الردود إلى "مقروءة"
        foreach ($message->replies as $reply) {
            if ($reply->status === 'unread' && $reply->user_id !== Auth::id()) {
                $reply->update(['status' => 'read']);
            }
        }

        return view('admin.messages.show', compact('message'));
    }

    public function adminUpdateStatusAndReply(Request $request, $id)
    {
        $request->validate([
            'status' => 'nullable|in:unread,opened,replied,closed',
            'content' => 'nullable|string|max:5000',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480',
        ]);

        // البحث في كلا الجدولين
        $message = Message::find($id) ?? MessageUser::find($id);

        if (!$message) {
            abort(404, 'الرسالة غير موجودة');
        }

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('message_replies', 'public');
        }

        // إضافة رد جديد باستخدام Polymorphic Relationship
        if ($request->filled('content') || $filePath) {
            $message->replies()->create([
                'user_id' => Auth::id(),
                'content' => $request->content,
                'file_path' => $filePath,
                'status' => 'unread',
            ]);

            $message->update(['status' => 'replied']);

            Log::info('Admin reply created by user ID: ' . Auth::id() . ' for message ID: ' . $message->id);
        }

        if ($request->filled('status') && !$request->filled('content') && !$filePath) {
            $message->update(['status' => $request->status]);
        }

        return redirect()->back()->with('success', 'تم التحديث بنجاح!');
    }

    public function adminDestroy($id)
    {
        $message = Message::find($id);

        if (!$message) {
            $message = MessageUser::findOrFail($id);
        }

        // حذف الملف المرفق إن وُجد
        if ($message->file_path) {
            Storage::disk('public')->delete($message->file_path);
        }

        // حذف ملفات الردود
        foreach ($message->replies as $reply) {
            if ($reply->file_path) {
                Storage::disk('public')->delete($reply->file_path);
            }
        }

        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'تم حذف الرسالة بنجاح!');
    }

    public function adminUpdateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:unread,opened,replied,closed',
        ]);

        $message = Message::find($id);

        if (!$message) {
            $message = MessageUser::findOrFail($id);
        }

        $message->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'message' => 'تم تحديث الحالة بنجاح',
            'status' => $message->status
        ]);
    }
    public function adminReply(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:5000',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4|max:20480',
        ]);
        $message = Message::find($id) ?? MessageUser::findOrFail($id);
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('message_replies', 'public');
        }
        $message->replies()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'file_path' => $filePath,
            'status' => 'unread',
        ]);
        $message->update(['status' => 'replied']);
        return redirect()->back()->with('success', 'تم إرسال الرد بنجاح!');
    }
}
