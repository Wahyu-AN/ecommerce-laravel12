<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman beranda storefront.
     */
    public function index(): View
    {
        // TODO Fase 3 & 4: ganti data demo ini dengan kategori & produk asli dari database.
        $demoCategories = ['Elektronik', 'Pakaian', 'Aksesoris', 'Rumah Tangga'];

        $demoProducts = [
            ['name' => 'Kaos Polos Premium', 'category' => 'Pakaian', 'price' => 85000],
            ['name' => 'Headset Bluetooth', 'category' => 'Elektronik', 'price' => 249000],
            ['name' => 'Tas Ransel Daily', 'category' => 'Aksesoris', 'price' => 175000],
            ['name' => 'Botol Minum 1L', 'category' => 'Rumah Tangga', 'price' => 65000],
        ];

        return view('shop.home', [
            'demoCategories' => $demoCategories,
            'demoProducts' => $demoProducts,
        ]);
    }
}