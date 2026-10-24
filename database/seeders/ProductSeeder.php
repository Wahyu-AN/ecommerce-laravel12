<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['name' => 'Headset Bluetooth Pro', 'category' => 'Elektronik', 'price' => 249000, 'compare_price' => 329000, 'stock' => 25, 'is_featured' => true],
            ['name' => 'Smartwatch Series 5', 'category' => 'Elektronik', 'price' => 450000, 'compare_price' => null, 'stock' => 12, 'is_featured' => true],
            ['name' => 'Kaos Polos Premium', 'category' => 'Pakaian', 'price' => 85000, 'compare_price' => 120000, 'stock' => 100, 'is_featured' => true],
            ['name' => 'Kemeja Flanel Kotak', 'category' => 'Pakaian', 'price' => 165000, 'compare_price' => null, 'stock' => 40, 'is_featured' => false],
            ['name' => 'Tas Ransel Daily', 'category' => 'Aksesoris', 'price' => 175000, 'compare_price' => 210000, 'stock' => 30, 'is_featured' => true],
            ['name' => 'Jam Tangan Minimalis', 'category' => 'Aksesoris', 'price' => 299000, 'compare_price' => null, 'stock' => 18, 'is_featured' => false],
            ['name' => 'Botol Minum 1L', 'category' => 'Rumah Tangga', 'price' => 65000, 'compare_price' => 85000, 'stock' => 75, 'is_featured' => false],
            ['name' => 'Set Wadah Makan 3in1', 'category' => 'Rumah Tangga', 'price' => 125000, 'compare_price' => null, 'stock' => 50, 'is_featured' => false],
        ];

        foreach ($items as $item) {
            $category = Category::where('name', $item['category'])->first();

            if ($category === null) {
                continue;
            }

            Product::updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'category_id' => $category->id,
                    'name' => $item['name'],
                    'description' => 'Deskripsi demo untuk '.$item['name'].'. Akan diperbarui saat data produk asli dimasukkan.',
                    'price' => $item['price'],
                    'compare_price' => $item['compare_price'],
                    'stock' => $item['stock'],
                    'is_active' => true,
                    'is_featured' => $item['is_featured'],
                ]
            );
        }
    }
}