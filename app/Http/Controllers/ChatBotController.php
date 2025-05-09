<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatMessage;

class ChatBotController extends Controller
{
    public function index()
    {
        return view('chatbot');
    }

    public function adminIndex()
    {
        return view('admin_chatbot');
    }

    public function sendMessage(Request $request)
    {
        $request->validate(['message' => 'required|string']);

        // Save message to the database
        $chatMessage = ChatMessage::create([
            'sender' => 'user',
            'message' => $request->message,
            'user_sender' => 'default_user_id', // Replace with a unique identifier for the user
            'admin_sender' => null, // Admin sender is not applicable here
        ]);

        // Log for debugging
        info('Chat message sent by user: ' . $chatMessage->message);

        // Return success response
        return response()->json(['success' => true, 'message' => 'Message sent']);
    }

    public function sendAdminMessage(Request $request)
    {
        $request->validate(['message' => 'required|string']);

        // Save message to the database
        $chatMessage = ChatMessage::create([
            'sender' => 'admin',
            'message' => $request->message,
            'user_sender' => null, // User sender is not applicable here
            'admin_sender' => 'default_admin_id', // Replace with a unique identifier for the admin
        ]);

        // Log for debugging
        info('Chat message sent by admin: ' . $chatMessage->message);

        // Return success response
        return response()->json(['success' => true, 'message' => 'Message sent']);
    }

    public function fetchMessages()
    {
        $messages = ChatMessage::orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

    public function deleteMessage($id)
{
    $message = ChatMessage::find($id);

    if ($message) {
        $message->delete();
        return response()->json(['success' => true, 'message' => 'Message deleted']);
    }

    return response()->json(['success' => false, 'message' => 'Message not found'], 404);
}
}
