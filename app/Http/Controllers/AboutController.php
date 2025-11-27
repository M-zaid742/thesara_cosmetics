<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
   public function index()
{
    $brand = [
        'tagline' => 'Reveal The Beauty Of Skin',
        'mission' => 'Elevate your natural beauty with our premium, science-backed skincare solutions.'
    ];

    $team = [
        [
            'name' => 'Sarah Johnson',
            'role' => 'Founder & CEO',
            'bio' => 'Passionate about clean beauty with 15 years in cosmetic science.'
        ],
        [
            'name' => 'Dr. Maria Chen',
            'role' => 'Chief Formulator',
            'bio' => 'PhD in Dermatology, specializing in natural ingredients.'
        ],
        [
            'name' => 'Alex Thompson',
            'role' => 'Creative Director',
            'bio' => 'Award-winning designer bringing beauty to life.'
        ]
    ];

    return view('about', compact('brand', 'team'));
}
}
