<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->with('images')
            ->latest('id')
            ->take(8)
            ->get();

        return view('shop.home', [
            'categories' => $categories,
            'featuredProducts' => $featuredProducts,
        ]);
    }
}