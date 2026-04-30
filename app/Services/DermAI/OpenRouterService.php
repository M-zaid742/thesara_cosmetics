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
CRITICAL RULE 2: If the user provides a text description but no image, try your best to provide a "clinical" response based on their description. However, if the query is too vague, is a general greeting, or you are truly unable to provide a safe diagnosis/routine, set "response_type" to "chat", set all other fields (treatments, routine, etc.) to null or empty arrays, and provide your full answer/response in the "explanation" field as simple text.

YOU MUST respond with a valid JSON block ONLY for EVERY interaction. Do not include any conversational text before or after the JSON.

RESPONSE TYPES:
- Use "clinical" when you are identifying a concern, providing a routine, or suggesting treatments (even if based only on text).
- Use "chat" for greetings, general skincare advice that doesn't involve a specific routine/treatment, or when you cannot provide a structured solution. In "chat" mode, your entire response should be in the "explanation" field.

JSON Structure:
{
    "response_type": "clinical/chat",
    "condition_detected": "Name of concern or 'Consultation'",
    "severity": "mild/moderate/severe/N/A",
    "explanation": "Detailed professional response or greeting",
    "treatments": {
        "otc": ["treatment1", "treatment2"],
        "prescription": ["prescription1"]
    },
    "diet_lifestyle": ["tip1", "tip2"],
    "skincare_routine": {
        "am": ["cleanser", "toner"],
        "pm": ["cleanser", "retinol"]
    },
    "suggested_products_names": ["Exact Name 1", "Exact Name 2"]
}
PROMPT;

    public function __construct()
    {
        $this->apiKey = env('OPENROUTER_API_KEY', env('GEMINI_API_KEY'));
    }

    protected function getDynamicPrompt(): string
    {
        $prompt = $this->systemPrompt;
        try {
            $products = \App\Models\Product::select('name', 'ingredients')->whereNotNull('ingredients')->get();
            if ($products->isNotEmpty()) {
                $prompt .= "\n\nAvailable Products and their Ingredients:\n";
                foreach ($products as $p) {
                    $prompt .= "- {$p->name}: {$p->ingredients}\n";
                }
                $prompt .= "\nWhen suggesting treatments or a skincare routine, strictly recommend these available products based on their ingredients matching the user's diagnosis. Include their exact names in the 'suggested_products_names' JSON array.";
            }
        } catch (\Exception $e) {
            // DB might not be ready
        }
        return $prompt;
    }

    /**
     * Send a general text chat message with context.
     */
    public function chat(array $history, string $newMessage)
    {
        $messages = [];
        
        $messages[] = [
            'role' => 'system',
            'content' => $this->getDynamicPrompt()
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

        $response = $this->makeRequest($messages);
        return $this->extractAndDecodeJson($response);
    }

    /**
     * Robustly extract and decode JSON from AI response.
     */
    protected function extractAndDecodeJson($response)
    {
        if (is_array($response)) return $response;

        // Try to find a JSON block between ```json and ```
        if (preg_match('/```json\s*(.*?)\s*```/s', $response, $matches)) {
            $decoded = json_decode(trim($matches[1]), true);
            if ($decoded) return $decoded;
        }

        // Try to find the first '{' and last '}'
        $firstBrace = strpos($response, '{');
        $lastBrace = strrpos($response, '}');

        if ($firstBrace !== false && $lastBrace !== false) {
            $potentialJson = substr($response, $firstBrace, $lastBrace - $firstBrace + 1);
            $decoded = json_decode(trim($potentialJson), true);
            if ($decoded) return $decoded;
        }

        // Fallback for non-JSON or broken JSON
        return [
            'response_type' => 'chat',
            'explanation' => $response,
            'raw_text' => $response
        ];
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
                'content' => $this->getDynamicPrompt()
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
        return $this->extractAndDecodeJson($response);
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
                'model' => 'google/gemini-2.5-flash',
                'messages' => $messages,
                'temperature' => 0.4
            ]);

            if ($response->successful()) {
                $data = $response->json();
                if (isset($data['choices'][0]['message']['content'])) {
                    return $data['choices'][0]['message']['content'];
                }
            }

            Log::error('OpenRouter API Error: ' . $response->status() . ' - ' . $response->body());
            $errorData = $response->json();
            $errorMessage = $errorData['error']['message'] ?? 'Unknown API error';
            return "I'm sorry, I encountered an error from the AI service: " . $errorMessage;

        } catch (\Exception $e) {
            Log::error('OpenRouter API Exception: ' . $e->getMessage());
            return "I'm sorry, a system error occurred while contacting DermAI.";
        }
    }
}
