<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use OpenAI;

class ChatbotController extends Controller {
    public function chat(Request $request) {
        $request->validate(['message' => 'required']);

        $client = OpenAI::client(env('OPENAI_API_KEY'));
        $response = $client->chat()->create([
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'You are a skincare assistant for Thesara Cosmetics. Provide guidance on products, orders, and skin concerns.'],
                ['role' => 'user', 'content' => $request->message],
            ],
        ]);

        return response()->json(['reply' => $response['choices'][0]['message']['content']]);
    }
}