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

        // Save user message
        ChatMessage::create([
            'chat_session_id' => $session->id,
            'role' => 'user',
            'message_text' => $request->message
        ]);

        // Get past messages for context
        $history = ChatMessage::where('chat_session_id', $session->id)
            ->oldest()
            ->get(['role', 'message_text'])
            ->toArray();

        // Get AI response
        $aiResponse = $openRouter->chat($history, $request->message);

        // Save AI message
        $aiMessage = ChatMessage::create([
            'chat_session_id' => $session->id,
            'role' => 'assistant',
            'message_text' => $aiResponse
        ]);

        return response()->json([
            'success' => true,
            'session_id' => $session->id,
            'response' => $aiResponse,
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
