<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageReply; // تأكد من استيراد موديل الردود
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // لاستخدام Auth::id()

class MessageController extends Controller
{
    // عرض صفحة إرسال رسالة جديدة (للمستخدمين)
    public function create()
    {
        return view('c1he3f.new-message');
    }

    // تخزين الرسالة الجديدة (للمستخدمين)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,png,mp4|max:10240',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
        }

        Message::create([
            'title' => $request->title,
            'content' => $request->content,
            'file_path' => $filePath,
            'status' => 'unread',
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('c1he3f.messages')->with('success', 'تم إرسال الرسالة بنجاح!');
    }

    // عرض قائمة الرسائل (للمستخدمين)
    public function index()
    {
        $messages = Message::where('user_id', Auth::id())->latest()->get();
        return view('c1he3f.messages', compact('messages'));
    }

    // عرض رسالة معينة (للمستخدمين)
    public function show($id) // هذه هي دالة عرض الرسالة للطاهي
    {
        // جلب الرسالة الأصلية مع المستخدم الذي أرسلها، والردود المتعلقة بها مع المستخدمين الذين أرسلوا الردود
        $message = Message::with(['user', 'replies.user'])->findOrFail($id);

        // هنا يمكنك تحديث حالة الرسالة الأصلية إلى 'opened' إذا كانت 'unread'
        // تأكد أن هذا التحديث لا يتم إلا إذا كان المتلقي (الطاهي) يفتحها، وليس المرسل (الطاهي)
        if ($message->status === 'unread' && $message->user_id !== Auth::id()) { // إذا لم يكن الطاهي هو من أرسل الرسالة الأصلية
            $message->status = 'opened';
            $message->save();
        }

        // تحديث حالة الردود إلى 'read' إذا كانت 'unread' ولم يرسلها الطاهي نفسه (أي إذا كانت من الأدمن)
        foreach ($message->replies as $reply) {
            if ($reply->status === 'unread' && $reply->user_id !== Auth::id()) {
                $reply->status = 'read';
                $reply->save();
            }
        }

        return view('c1he3f.chat', compact('message')); // يجب أن يكون view لعرض الشات للطاهي
    }

    public function chefIndex()
    {
        // عرض الرسائل التي أرسلها الشيف (كمستخدم)
        $sentMessages = Message::where('user_id', Auth::id())->latest()->get();

        // عرض الرسائل التي تلقى الشيف ردودًا عليها من الأدمن
        // (إذا كان هناك نظام ردود منفصلة أو إذا كنت تعتبر الرسالة الأصلية هي نقطة البدء)
        // هذا الجزء يعتمد على كيفية ربط الرسائل والردود باليوزرز (الشيف والأدمن).
        // مثال بسيط: افترض أن الشيف يرى كل الرسائل التي هو طرف فيها.
        $receivedReplies = MessageReply::where('user_id', Auth::id())->with('message')->latest()->get();
        // أو إذا كانت الرسالة الأصلية تخص الأدمن ويرد عليها الشيف، ستحتاج منطقاً مختلفاً.

        // لتبسيط المثال، سأفترض أن الشيف يمكنه فقط الرد على الرسائل التي بدأها.
        // أو أن الشيف يرى كل الرسائل التي يكون هو الـ user_id فيها أو الرسائل التي تم الرد عليها من قبل الأدمن
        // هذا يتطلب بناء علاقات في الموديل بشكل صحيح.
        // لأغراض العرض، لنعرض رسائل الشيف فقط هنا.
        $messages = Message::where('user_id', Auth::id())->orWhereHas('replies', function ($query) {
            $query->where('user_id', Auth::id());
        })->with('user', 'replies.user')->latest()->get();


        return view('chef.messages.index', compact('messages'));
    }

    /**
     * عرض رسالة محددة للشيف مع ردودها.
     */
    public function chefShow(Message $message)
    {
        // تأكد أن الشيف المصرح له هو من يرى هذه الرسالة أو أنه طرف في أي من ردودها
        // أو أن الشيف هو المرسل الأصلي.
        // يمكن أن تحتاج لتحسين هذا الشرط حسب منطق تطبيقك الدقيق
        if ($message->user_id !== Auth::id() && !$message->replies->contains('user_id', Auth::id())) {
            abort(403, 'غير مصرح لك بمشاهدة هذه الرسالة.');
        }

        // تحديث حالة الرسالة إذا كانت غير مقروءة وفتحها الشيف
        // (يمكنك هنا تحديث حالة الردود أيضًا إذا كان هناك موديل MessageReply)
        // إذا كان $message هو الرسالة الأصلية المرسلة من الشيف، فقد لا تحتاج لتحديث حالتها هنا
        // إذا كان الشيف يرى رسالة من الأدمن
        if ($message->status === 'unread' && $message->user_id == Auth::id()) {
            $message->status = 'opened';
            $message->save();
        }

        // إذا كنت تدير حالة الردود، يمكنك القيام بذلك هنا.
        // على سبيل المثال، إذا كان الأدمن قد رد على الشيف، وكان الرد غير مقروء من الشيف:
        // MessageReply::where('message_id', $message->id)
        //            ->where('user_id', '!=', Auth::id()) // الردود المرسلة من غير الشيف
        //            ->where('status', 'unread')
        //            ->update(['status' => 'read']);


        return view('chef.messages.show', compact('message'));
    }
    public function chefCreate()
    {
        return view('chef.messages.create');
    }

    /**
     * تخزين رسالة جديدة من الشيف.
     */
    public function chefStore(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480', // 20MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('message_files', 'public');
        }

        Message::create([
            'user_id' => Auth::id(), // الشيف هو من يرسل الرسالة
            'title' => $request->title,
            'content' => $request->content,
            'file_path' => $filePath,
            'status' => 'unread', // الحالة الافتراضية عند إرسال رسالة جديدة
            'type' => 'chef_to_admin', // نوع الرسالة
        ]);

        return redirect()->route('c1he3f.messages')->with('success', 'تم إرسال رسالتك بنجاح!');
    }


    /**
     * إرسال رد من الشيف على رسالة.
     * هذا هو الرد من الشيف على رسالة أصلية (سواء كانت رسالته أو رسالة من الأدمن).
     */
    public function chefReply(Request $request, Message $message)
    {
        Log::info('Entering chefReply method for message ID: ' . $message->id);
        Log::info('Current message status before reply: ' . $message->status);

        $request->validate([
            'content' => 'required|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480', // 20MB
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('message_replies', 'public');
            Log::info('File uploaded for reply: ' . $filePath);
        }

        // Create a new reply in the message_replies table
        $newReply = MessageReply::create([
            'message_id' => $message->id,
            'user_id' => Auth::id(), // The chef is replying
            'content' => $request->content,
            'file_path' => $filePath,
            'status' => 'unread', // Reply is unread for the other party (admin)
        ]);
        Log::info('New MessageReply created with ID: ' . $newReply->id . ' by user ID: ' . Auth::id() . ' with status: ' . $newReply->status);

        // Update the original message's status to 'replied'
        if ($message->status !== 'replied') {
            $message->status = 'replied';
            $message->save();
            Log::info('Original message status updated to replied for message ID: ' . $message->id);
        } else {
            Log::info('Original message status was already replied for message ID: ' . $message->id . '. No update needed.');
        }

        return back()->with('success', 'تم إرسال ردك بنجاح!');
    }

    // في app/Http/Controllers/MessageController.php (أو Admin/MessageController.php)
    public function adminUpdate(Request $request, $id)
    {
        // نفس منطق دالة reply السابقة، ولكن هنا تقوم بتحديث الرسالة بشكل عام
        \Log::info('Update Request Data:', $request->all());

        $request->validate([
            'response' => 'nullable|string',
            'status' => 'required|string|in:unread,opened,replied,closed',
        ]);

        $message = Message::findOrFail($id);

        $message->status = $request->input('status');

        if ($request->filled('response')) {
            $message->response = $request->response;
        }

        $updated = $message->save();

        \Log::info('Message Updated Status:', ['updated' => $updated, 'new_status' => $message->status]);

        return redirect()->route('admin.messages.show', $message->id)->with('success', 'تم تحديث الرسالة بنجاح!');
        // يمكن التوجيه لـ show لكي تبقى في نفس صفحة تفاصيل الرسالة
    }
    // الرد على رسالة (للمستخدمين)
    public function reply(Request $request, $id)
    {
        Log::info('User Reply Request Data (from reply function):', $request->all());

        $request->validate([
            'content' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:20480',
        ]);

        $message = Message::findOrFail($id);
        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('replies_attachments', 'public');
        }

        if ($request->filled('content') || $request->hasFile('file')) {
            $reply = new MessageReply();
            $reply->message_id = $message->id;
            $reply->user_id = Auth::id();
            $reply->content = $request->content;
            $reply->file_path = $filePath;
            $reply->status = 'unread';
            $reply->save();

            // Update the original message's status to 'replied'
            if ($message->status !== 'replied') {
                $message->status = 'replied';
                $message->save();
                Log::info('Original message status updated to replied by "reply" function for message ID: ' . $message->id);
            } else {
                Log::info('Original message status was already replied for message ID: ' . $message->id . '. No update needed.');
            }

            Log::info('New User Message Reply Created (from reply function):', ['message_id' => $message->id, 'reply_id' => $reply->id, 'sender_id' => Auth::id()]);
            $successMessage = 'تم إرسال ردك بنجاح!';
        } else {
            $successMessage = 'لم يتم إرسال رد جديد.';
        }

        return redirect()->route('c1he3f.messages.show', $message->id)->with('success', $successMessage);
    }

    // عرض قائمة الرسائل (للأدمن)
    public function adminIndex()
    {
        $messages = Message::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    public function adminShow($id)
    {
        // جلب الرسالة الأصلية مع المستخدم الذي أرسلها، والردود المتعلقة بها مع المستخدمين الذين أرسلوا الردود
        $message = Message::with(['user', 'replies.user'])->findOrFail($id);

        // هنا يمكنك تحديث حالة الرسالة الأصلية إلى 'opened' إذا كانت 'unread'
        if ($message->status === 'unread') {
            $message->status = 'opened';
            $message->save();
        }

        // تحديث حالة الردود إلى 'read' إذا كانت 'unread' ولم يرسلها الأدمن نفسه
        foreach ($message->replies as $reply) {
            if ($reply->status === 'unread' && $reply->user_id !== Auth::id()) {
                $reply->status = 'read';
                $reply->save();
            }
        }

        return view('admin.messages.show', compact('message'));
    }
    // في App\Http\Controllers\MessageController.php

    // دالة جديدة: معالجة الرد وتعديل الحالة (للأدمن)
    public function adminUpdateStatusAndReply(Request $request, $messageId)
    {
        Log::info('Admin Update Status and Reply Request Data:', $request->all());

        $request->validate([
            'content' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:20480',
            'status' => 'required|string|in:unread,opened,replied,closed',
        ]);

        $message = Message::findOrFail($messageId);
        $filePath = null;

        // Create a new reply if content or file is provided
        if ($request->filled('content') || $request->hasFile('file')) {
            if ($request->hasFile('file')) {
                $filePath = $request->file('file')->store('replies_attachments', 'public');
            }

            $reply = new MessageReply();
            $reply->message_id = $message->id;
            $reply->user_id = Auth::id(); // Admin is replying
            $reply->content = $request->content;
            $reply->file_path = $filePath;
            $reply->status = 'unread'; // Reply is unread for the other party
            $reply->save();
            Log::info('New Message Reply Created:', ['message_id' => $message->id, 'reply_id' => $reply->id, 'sender_id' => Auth::id()]);

            // Set the original message's status to 'replied' since a reply was created
            $message->status = 'replied';
        } else {
            // If no reply is created, use the status from the dropdown
            $message->status = $request->input('status');
            Log::info('No reply content or file, only status updated for message:', ['message_id' => $message->id]);
        }

        $message->save();
        Log::info('Original Message Status Updated:', ['message_id' => $message->id, 'new_status' => $message->status]);

        return redirect()->route('admin.messages.message-show', $message->id)->with('success', 'تم إرسال الرد وتحديث الحالة بنجاح!');
    }
    
    public function adminReply(Request $request, $id)
    {
        Log::info('Admin Reply Request Data:', $request->all());

        $request->validate([
            'content' => 'required_without_all:file|nullable|string',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,mov,avi|max:20480',
        ]);

        $message = Message::findOrFail($id);
        $filePath = null;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('replies_attachments', 'public');
        }

        // Create a new reply
        $reply = new MessageReply();
        $reply->message_id = $message->id;
        $reply->user_id = Auth::id(); // Admin is replying
        $reply->content = $request->content;
        $reply->file_path = $filePath;
        $reply->status = 'unread'; // Reply is unread for the other party
        $reply->save();

        // Update the original message's status to 'replied'
        if ($message->status !== 'replied') {
            $message->status = 'replied';
            $message->save();
            Log::info('Original message status updated to replied for message ID: ' . $message->id);
        } else {
            Log::info('Original message status was already replied for message ID: ' . $message->id . '. No update needed.');
        }

        Log::info('New Message Reply Created:', ['message_id' => $message->id, 'reply_id' => $reply->id, 'sender_id' => Auth::id()]);

        return redirect()->route('admin.messages.show', $message->id)->with('success', 'تم إرسال الرد بنجاح!');
    }

    // حذف رسالة (للأدمن)
    public function adminDestroy($id)
    {
        $message = Message::findOrFail($id);
        if ($message->file_path) {
            Storage::disk('public')->delete($message->file_path);
        }
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'تم حذف الرسالة بنجاح!');
    }
}
