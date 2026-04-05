<?php

namespace App\Services\DermAI;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenRouterService
{
    protected string $apiKey;
    protected string $baseUrl = 'https://openrouter.ai/api/v1/chat/completions';

    protected string $systemPrompt = <<<PROMPT
You are DermAI, a certified professional dermatologist with 20+ years of clinical experience in diagnosing and treating all types of skin conditions. Your role is to:
1. Carefully analyze any skin images provided and identify visible conditions with clinical accuracy.
2. Provide a diagnosis with the condition name, severity (mild/moderate/severe), and a clear explanation of what is observed.
3. Suggest safe, evidence-based topical treatments and medications (OTC first, then prescription-grade with a disclaimer to consult a physician before use).
4. Provide dietary changes, supplement recommendations, and lifestyle improvements that support skin healing.
5. Build a personalized AM/PM skincare routine based on the condition and skin type.
6. Answer follow-up questions conversationally, clearly, and professionally.
7. Always include a disclaimer: "This is AI-generated advice. Please consult a licensed dermatologist before starting any new medication or treatment."
CRITICAL RULE: You are strictly limited to discussing dermatology, skincare, cosmetics, and skin/hair/nail health. If the user asks a question about coding, math, general knowledge, politics, or ANY topic outside of skin health and cosmetics, you MUST immediately decline to answer. Reply with: "I am DermAI, an AI specialized strictly in dermatology and skincare. I cannot answer questions unrelated to skin health." Do not provide any partial answer to off-topic queries.
Never refuse to answer skin-related questions. Be compassionate, clear, and detailed in every skincare response.

Provide your response strictly in JSON format matching the following structure ONLY for image analysis. When answering regular chat messages, return plain conversational text formatted in Markdown.
If the prompt contains an image, ALWAYS return a JSON string block:
{
    "condition_detected": "Name of the condition",
    "severity": "mild/moderate/severe",
    "explanation": "Detailed explanation of what is observed",
    "treatments": {
        "otc": ["treatment1", "treatment2"],
        "prescription": ["prescription1"]
    },
    "diet_lifestyle": ["tip1", "tip2"],
    "skincare_routine": {
        "am": ["cleanser", "toner"],
        "pm": ["cleanser", "retinol"]
    }
}
PROMPT;

    public function __construct()
    {
        $this->apiKey = env('OPENROUTER_API_KEY', env('GEMINI_API_KEY'));
    }

    /**
     * Send a general text chat message with context.
     */
    public function chat(array $history, string $newMessage)
    {
        $messages = [];
        
        $messages[] = [
            'role' => 'system',
            'content' => $this->systemPrompt
        ];

        // Format history
        foreach ($history as $msg) {
            $messages[] = [
                'role' => $msg['role'] === 'assistant' ? 'assistant' : 'user',
                'content' => $msg['message_text']
            ];
        }

        // Add the new message
        $messages[] = [
            'role' => 'user',
            'content' => $newMessage
        ];

        return $this->makeRequest($messages);
    }

    /**
     * Analyze an image.
     */
    public function analyzeImage(string $base64Image, string $mimeType = 'image/jpeg')
    {
        $base64Str = base64_encode($base64Image);
        $imageUrl = "data:{$mimeType};base64,{$base64Str}";

        $messages = [
            [
                'role' => 'system',
                'content' => $this->systemPrompt
            ],
            [
                'role' => 'user',
                'content' => [
                    [
                        'type' => 'text',
                        'text' => 'Please analyze this image and output the requested JSON.'
                    ],
                    [
                        'type' => 'image_url',
                        'image_url' => [
                            'url' => $imageUrl
                        ]
                    ]
                ]
            ]
        ];

        $response = $this->makeRequest($messages);

        // Sanitize the response if it is wrapped in markdown JSON blocks
        $jsonStr = preg_replace('/```json|```/i', '', $response);
        return json_decode(trim($jsonStr), true) ?: ['raw_text' => $response];
    }

    protected function makeRequest(array $messages)
    {
        if (!$this->apiKey) {
            Log::error('OpenRouter API key is missing.');
            return "Error: OpenRouter API key is not configured.";
        }

        try {
            $response = Http::timeout(120)->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . $this->apiKey,
                'HTTP-Referer' => config('app.url'),
                'X-Title' => 'DermAI'
            ])->post($this->baseUrl, [
                'model' => 'google/gemini-2.5-pro',
                'messages' => $messages,
                'temperature' => 0.4
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['choices'][0]['message']['content'])) {
                    return $data['choices'][0]['message']['content'];
                }
            }

            Log::error('OpenRouter API Error: ' . $response->body());
            return "I'm sorry, I encountered an error while trying to process your request.";

        } catch (\Exception $e) {
            Log::error('OpenRouter API Exception: ' . $e->getMessage());
            return "I'm sorry, a system error occurred.";
        }
    }
}
