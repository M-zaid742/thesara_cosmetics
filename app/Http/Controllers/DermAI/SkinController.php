<?php

namespace App\Http\Controllers\DermAI;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Services\DermAI\OpenRouterService;
use App\Models\DermAI\SkinAnalysis;
use Illuminate\Support\Facades\Storage;

class SkinController extends Controller
{
    public function analyzeImage(Request $request, OpenRouterService $openRouter)
    {
        set_time_limit(120);
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120'
        ]);

        $user = auth()->user();
        $file = $request->file('image');
        $path = $file->store('private/skin_images');
        
        $base64Image = base64_encode(Storage::get($path));
        $mimeType = $file->getMimeType();

        // Call Gemini
        $analysisResult = $openRouter->analyzeImage(Storage::get($path), $mimeType);

        // Create Analysis record
        $analysis = SkinAnalysis::create([
            'user_id' => $user->id,
            'image_path' => $path,
            'gemini_response' => $analysisResult,
            'condition_detected' => $analysisResult['condition_detected'] ?? 'Unknown',
            'severity' => $analysisResult['severity'] ?? 'Unknown'
        ]);

        return response()->json([
            'success' => true,
            'analysis_id' => $analysis->id,
            'data' => $analysisResult
        ]);
    }
}
