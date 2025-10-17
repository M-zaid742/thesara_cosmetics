<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkinAnalysis;
use Auth;
use Storage;

class SkinAnalysisController extends Controller {
    public function upload(Request $request) {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png|max:5120', // 5MB as per business rules
        ]);

        $path = $request->file('image')->store('skin_images', 'public');

        // Call Python AI script for analysis
        $pythonScript = base_path('python/ai_skin_analysis.py');
        $output = shell_exec("python $pythonScript " . storage_path('app/public/' . $path));
        $result = json_decode($output, true) ?? ['error' => 'Analysis failed']; // e.g., {'conditions': ['acne']}

        $analysis = SkinAnalysis::create([
            'user_id' => Auth::user()->id,
            'image_path' => $path,
            'analysis_result' => json_encode($result),
        ]);

        // Generate recommendations based on result (FR-3)
        $recommendations = $this->getRecommendations($result['conditions'] ?? []);

        return view('skin.analysis', compact('analysis', 'recommendations'))->with('disclaimer', 'This is not professional medical advice.');
    }

    private function getRecommendations($conditions) {
        // Query products matching conditions (e.g., products for 'acne')
        return Product::whereIn('category', $conditions)->get();
    }
}