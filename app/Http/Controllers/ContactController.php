<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        Contact::create([
            'email' => $validated['email'],
            'message' => $validated['message'],
            'status' => 'unread', // Default status
        ]);

        return redirect()->back()->with('success', 'شكرًا لتواصلك معنا! تم استلام رسالتك بنجاح وسيتم الرد عليك قريبًا.');
    }

    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    public function markAsRead($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => 'read']);

        return redirect()->back()->with('success', 'تم تعليم الرسالة كمقروءة.');
    }

    public function markAsReplied($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->update(['status' => 'replied']);

        return redirect()->back()->with('success', 'تم تعليم الرسالة كتم الرد.');
    }
}
