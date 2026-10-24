<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Elektronik', 'description' => 'Gadget, audio, dan aksesori elektronik.'],
            ['name' => 'Pakaian', 'description' => 'Pakaian pria dan wanita untuk segala usia.'],
            ['name' => 'Aksesoris', 'description' => 'Tas, jam tangan, dan aksesoris lainnya.'],
            ['name' => 'Rumah Tangga', 'description' => 'Peralatan dan perlengkapan rumah tangga.'],
        ];

        foreach ($categories as $data) {
            Category::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                $data + ['is_active' => true]
            );
        }
    }
}