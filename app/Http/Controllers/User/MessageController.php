<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MessageUser;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $messages = MessageUser::where('user_id', Auth::id())
            ->orWhereHas('replies', function ($query) { 
                $query->where('user_id', Auth::id());
            })->with('user', 'replies.user')->latest()->get();
        return view('users.messages.index', compact('messages'));
    }

    public function create()
    {
        return view('users.messages.create');
    }


    public function showUser(MessageUser $message)
    {
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

        return view('users.messages.chat', compact('message'));
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

        MessageUser::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
            'file_path' => $filePath,
            'status' => 'unread',
            // 'type' => 'user_to_admin',
        ]);

        return redirect()->route('users.messages.index')->with('success', 'تم إرسال الرسالة بنجاح!');
    }
}
