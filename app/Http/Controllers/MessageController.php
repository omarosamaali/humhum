<?php

namespace App\Http\Controllers;

use App\Models\Message;
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
            'type' => 'user_to_admin',
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

    public function show(Message $message)
    {
        if ($message->user_id !== Auth::id() && !$message->replies->contains('user_id', Auth::id())) {
            abort(403, 'غير مصرح لك بمشاهدة هذه الرسالة.');
        }

        if ($message->user_id !== Auth::id() && $message->status === 'unread') {
            $message->status = 'opened';
            $message->save();
        }

        foreach ($message->replies as $reply) {
            if ($reply->status === 'unread' && $reply->user_id !== Auth::id()) {
                $reply->status = 'read';
                $reply->save();
            }
        }

        return view('c1he3f.chat', compact('message'));
    }

    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'content' => 'required_without_all:file|nullable|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('replies_attachments', 'public');
        }

        if ($request->filled('content') || $request->hasFile('file')) {
            $reply = MessageReply::create([
                'message_id' => $message->id,
                'user_id' => Auth::id(),
                'content' => $request->content,
                'file_path' => $filePath,
                'status' => 'unread',
            ]);

            $message->status = 'replied';
            $message->save();

            Log::info('New Message Reply created by user ID: ' . Auth::id() . ' for message ID: ' . $message->id);
            return back()->with('success', 'تم إرسال ردك بنجاح!');
        }

        return back()->with('error', 'يجب إدخال محتوى أو ملف لإرسال الرد.');
    }

    public function adminIndex()
    {
        $messages = Message::latest()->paginate(10);
        return view('admin.messages.index', compact('messages'));
    }

    public function adminShow(Message $message)
    {
        $message->load(['user', 'replies.user']);

        if ($message->status === 'unread') {
            $message->status = 'opened';
            $message->save();
        }

        foreach ($message->replies as $reply) {
            if ($reply->status === 'unread' && $reply->user_id !== Auth::id()) {
                $reply->status = 'read';
                $reply->save();
            }
        }

        return view('admin.messages.show', compact('message'));
    }

    public function adminReplyAndStatus(Request $request, Message $message)
    {
        $request->validate([
            'content' => 'required_without_all:file|nullable|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi|max:20480',
            'status' => 'required|string|in:unread,opened,replied,closed',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('replies_attachments', 'public');
        }

        if ($request->filled('content') || $request->hasFile('file')) {
            MessageReply::create([
                'message_id' => $message->id,
                'user_id' => Auth::id(),
                'content' => $request->content,
                'file_path' => $filePath,
                'status' => 'unread',
            ]);
            $message->status = 'replied';
        } else {
            $message->status = $request->input('status');
        }

        $message->save();

        return redirect()->route('admin.messages.show', $message->id)->with('success', 'تم تحديث الرسالة وإرسال الرد بنجاح!');
    }

    public function adminDestroy(Message $message)
    {
        if ($message->file_path) {
            Storage::disk('public')->delete($message->file_path);
        }
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'تم حذف الرسالة بنجاح!');
    }
}
