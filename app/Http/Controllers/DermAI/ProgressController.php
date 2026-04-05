<?php

namespace App\Http\Controllers\DermAI;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\DermAI\SkinAnalysis;
use App\Models\DermAI\ProgressLog;

class ProgressController extends Controller
{
    public function index()
    {
        $analyses = SkinAnalysis::where('user_id', auth()->id())
            ->with('progressLogs')
            ->latest()
            ->get();
            
        return view('dermai.progress', compact('analyses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'analysis_id' => 'required|exists:skin_analyses,id',
            'notes' => 'nullable|string',
            'follow_up_image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120'
        ]);

        // Ensure user owns this analysis
        $analysis = SkinAnalysis::where('id', $request->analysis_id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $path = null;
        if ($request->hasFile('follow_up_image')) {
            $path = $request->file('follow_up_image')->store('private/skin_images');
        }

        $log = ProgressLog::create([
            'user_id' => auth()->id(),
            'skin_analysis_id' => $analysis->id,
            'notes' => $request->notes,
            'follow_up_image_path' => $path
        ]);

        return back()->with('success', 'Progress log added successfully!');
    }
}
