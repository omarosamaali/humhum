<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MessageController extends Controller
{
    // عرض صفحة إرسال رسالة جديدة
    public function create()
    {
        return view('c1he3f.new-message');
    }

    // تخزين الرسالة الجديدة
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'file' => 'nullable|file|mimes:jpg,png,mp4|max:10240', // صور أو فيديو بحد أقصى 10MB
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
        ]);

        return redirect()->route('c1he3f.messages')->with('success', 'تم إرسال الرسالة بنجاح!');
    }

    // عرض قائمة الرسائل (الداشبورد)
    public function index()
    {
        $messages = Message::latest()->get();
        return view('c1he3f.messages', compact('messages'));
    }

    // عرض رسالة معينة
    public function show($id)
    {
        $message = Message::findOrFail($id);
        if ($message->status === 'unread') {
            $message->update(['status' => 'opened']);
        }
        return view('c1he3f.chat', compact('message'));
    }

    // الرد على رسالة
    public function reply(Request $request, $id)
    {
        $request->validate([
            'response' => 'required|string',
        ]);

        $message = Message::findOrFail($id);
        $message->update([
            'response' => $request->response,
            'status' => 'replied',
        ]);

        return redirect()->route('c1he3f.messages')->with('success', 'تم الرد على الرسالة بنجاح!');
    }
}
