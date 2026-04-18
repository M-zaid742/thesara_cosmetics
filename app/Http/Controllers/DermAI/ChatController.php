<?php

namespace App\Http\Controllers\DermAI;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\DermAI\OpenRouterService;
use App\Models\DermAI\ChatSession;
use App\Models\DermAI\ChatMessage;

class ChatController extends Controller
{
    public function index()
    {
        return view('dermai.chat');
    }

    public function sendMessage(Request $request, OpenRouterService $openRouter)
    {
        $request->validate([
            'message' => 'required|string',
            'session_id' => 'nullable|exists:chat_sessions,id'
        ]);

        $user = auth()->user();
        $session = null;

        if ($request->session_id) {
            $session = ChatSession::where('id', $request->session_id)->where('user_id', $user->id)->firstOrFail();
        } else {
            $session = ChatSession::create([
                'user_id' => $user->id,
                'session_title' => substr($request->message, 0, 50) . '...'
            ]);
        }

        // Get past messages for context (before adding the new one)
        $history = ChatMessage::where('chat_session_id', $session->id)
            ->oldest()
            ->get(['role', 'message_text'])
            ->toArray();

        // Save current user message to DB
        ChatMessage::create([
            'chat_session_id' => $session->id,
            'role' => 'user',
            'message_text' => $request->message
        ]);

        // Get AI response (using history excluding the message we just saved, since chat() will add it)
        $aiResponse = $openRouter->chat($history, $request->message);

        // Fetch suggested products explicitly
        if (isset($aiResponse['suggested_products_names']) && is_array($aiResponse['suggested_products_names'])) {
            $products = \App\Models\Product::whereIn('name', $aiResponse['suggested_products_names'])->get();
            $aiResponse['products_data'] = $products->map(function($p) {
                return [
                    'id' => $p->id,
                    'name' => $p->name,
                    'image_url' => asset($p->image_url),
                    'price' => $p->price
                ];
            });
        }

        // Save AI message as JSON string
        $aiMessage = ChatMessage::create([
            'chat_session_id' => $session->id,
            'role' => 'assistant',
            'message_text' => json_encode($aiResponse)
        ]);

        return response()->json([
            'success' => true,
            'session_id' => $session->id,
            'response' => $aiResponse, // Return as array/object for the client
            'message_id' => $aiMessage->id
        ]);
    }

    public function getHistory(Request $request)
    {
        $sessions = ChatSession::where('user_id', auth()->id())
            ->with(['messages' => function ($q) {
                $q->oldest();
            }])
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'sessions' => $sessions
        ]);
    }
}
