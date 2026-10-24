<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Daftar produk publik dengan filter, pencarian, dan sorting.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q'));
        $categoryId = $request->integer('category') ?: null;
        $sort = $request->query('sort', 'latest');

        $query = Product::query()
            ->where('is_active', true)
            ->with(['category', 'images'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($w) use ($search) {
                    $w->where('name', 'like', '%'.$search.'%')
                      ->orWhere('sku', 'like', '%'.$search.'%');
                });
            })
            ->when($categoryId, function ($q) use ($categoryId) {
                $q->where('category_id', $categoryId);
            });

        // Sorting - pakai if-else agar lebih kompatibel
        if ($sort === 'price_low') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_high') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest('id');
        }

        $products = $query->paginate(12)->withQueryString();

        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('shop.products.index', [
            'products' => $products,
            'categories' => $categories,
            'search' => $search,
            'categoryId' => $categoryId,
            'sort' => $sort,
        ]);
    }

    /**
     * Detail produk berdasarkan slug.
     */
    public function show(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $product->load(['category', 'images']);

        $relatedProducts = Product::query()
            ->where('is_active', true)
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->with('images')
            ->latest('id')
            ->take(4)
            ->get();

        return view('shop.products.show', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
        ]);
    }
}