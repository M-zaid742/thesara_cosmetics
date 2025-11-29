<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function faq()
    {
        $faqs = [
            [
                'question' => 'Are your products cruelty-free?',
                'answer' => 'Yes, all Thesara Cosmetics products are 100% cruelty-free.'
            ],
            [
                'question' => 'Do you offer international shipping?',
                'answer' => 'Yes! We ship to most countries with fast delivery options.'
            ],
            [
                'question' => 'Are your products suitable for sensitive skin?',
                'answer' => 'Our products are dermatologically tested and safe for most skin types.'
            ],
            [
                'question' => 'How can I track my order?',
                'answer' => 'You’ll receive a tracking link once your order is shipped.'
            ]
        ];
        

        return view('faq', compact('faqs'));
    }
    public function checkout()
{
    return view('checkout');
}
}
