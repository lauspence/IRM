<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // Show received messages (Inbox)
    public function inbox()
    {
        $messages = Message::where('recipient_id', Auth::id())
            ->latest()
            ->get();

        return view('staff.messages.inbox', compact('messages'));
    }

    // Show sent messages (Outbox)
    public function outbox()
    {
        $messages = Message::where('sender_id', Auth::id())
            ->latest()
            ->get();

        return view('staff.messages.outbox', compact('messages'));
    }

    // Show form to compose a new message
    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get(); // exclude current user

        $recentMessages = Message::where('recipient_id', Auth::id())
            ->latest()
            ->take(5) // show last 5 messages
            ->get();
        return view('staff.messages.create', compact('users', 'recentMessages'));
    }

    // Save new message
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'subject' => $request->subject,
            'body' => $request->body,
            'is_read' => false,
        ]);

        return redirect()->route('staff.messages.outbox')->with('success', 'Message sent successfully!');
    }

    // Show a single message
    public function show(Message $message)
    {
        // Ensure the user is either sender or recipient
        if ($message->recipient_id !== Auth::id() && $message->sender_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        // Mark as read if the recipient is opening it
        if ($message->recipient_id === Auth::id() && !$message->is_read) {
            $message->update(['is_read' => true]);
        }

        return view('staff.messages.show', compact('message'));
    }
}
