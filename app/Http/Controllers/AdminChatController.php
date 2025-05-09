<?php

namespace App\Http\Controllers;

use App\Events\UserRequestAccepted;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminChatController extends Controller
{
    // This method can return a view for the admin chat interface
    public function index()
    {
        return view('admin_chatbot'); // Ensure this matches the name of your Blade view
    }

    // Method to handle incoming user requests
    public function userRequest(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'userName' => 'required|string|max:255', // Validate the user name
        ]);

        // Broadcast the user request to the admin channel
        try {
            broadcast(new UserRequestAccepted($request->userName));

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error notifying admin: ' . $e->getMessage());
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    // Method to send messages from the admin
    public function sendMessage(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'message' => 'required|string',
        ]);

        // Logic to handle sending a message
        $messageContent = $request->input('message');

        // Store the message in the database
        Message::create([
            'user_id' => Auth::id(), // Now this will work
            'content' => $messageContent,
            'is_admin' => true, // Assuming the message is from the admin
        ]);

        // Send a response back to the user
        return response()->json(['response' => "Message sent: $messageContent"]);
    }
}
