<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class PageController extends Controller
{
    public function home()
    {
        $categoryRows = Product::query()
            ->selectRaw('MIN(id) as id, category, COUNT(*) as product_count')
            ->whereNotNull('category')
            ->where('category', '!=', '')
            ->groupBy('category')
            ->orderBy('category')
            ->get();

        $productsById = Product::query()
            ->with(['images' => function ($query) {
                $query->select('id', 'product_id', 'image_path')->orderBy('id');
            }])
            ->whereIn('id', $categoryRows->pluck('id'))
            ->get()
            ->keyBy('id');

        $categories = $categoryRows->map(function ($row) use ($productsById) {
            $product = $productsById->get($row->id);

            $imagePath = null;
            if ($product) {
                $imagePath = $product->image_url ?: ($product->images->first()?->image_path);
            }

            return [
                'name' => $row->category,
                'count' => (int) $row->product_count,
                'image_path' => $imagePath,
            ];
        });

        return view('welcome', compact('categories'));
    }

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
