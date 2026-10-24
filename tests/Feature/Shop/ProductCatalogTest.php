<?php

namespace Tests\Feature\Shop;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductCatalogTest extends TestCase
{
    use RefreshDatabase;

    private function activeProduct(array $overrides = []): Product
    {
        $category = Category::create(['name' => 'Elektronik']);

        return Product::create(array_merge([
            'category_id' => $category->id,
            'name' => 'Headset Bluetooth',
            'price' => 250000,
            'stock' => 10,
            'is_active' => true,
        ], $overrides));
    }

    public function test_product_index_page_loads(): void
    {
        $this->activeProduct();

        $this->get(route('shop.products.index'))
            ->assertOk()
            ->assertSee('Headset Bluetooth');
    }

    public function test_inactive_product_not_shown_in_index(): void
    {
        $this->activeProduct(['is_active' => false]);

        $this->get(route('shop.products.index'))
            ->assertOk()
            ->assertDontSee('Headset Bluetooth');
    }

    public function test_product_index_can_filter_by_category(): void
    {
        $category = Category::create(['name' => 'Elektronik']);
        $otherCategory = Category::create(['name' => 'Pakaian']);

        Product::create([
            'category_id' => $category->id,
            'name' => 'Headset',
            'price' => 100000,
            'stock' => 5,
            'is_active' => true,
        ]);

        Product::create([
            'category_id' => $otherCategory->id,
            'name' => 'Kaos',
            'price' => 50000,
            'stock' => 5,
            'is_active' => true,
        ]);

        $this->get(route('shop.products.index', ['category' => $category->id]))
            ->assertOk()
            ->assertSee('Headset')
            ->assertDontSee('Kaos');
    }

    public function test_product_index_can_search_by_name(): void
    {
        $this->activeProduct(['name' => 'Headset Bluetooth Pro']);
        $this->activeProduct(['name' => 'Kaos Polos']);

        $this->get(route('shop.products.index', ['q' => 'headset']))
            ->assertOk()
            ->assertSee('Headset Bluetooth Pro')
            ->assertDontSee('Kaos Polos');
    }

    public function test_product_show_page_loads(): void
    {
        $product = $this->activeProduct();

        $this->get(route('shop.products.show', $product))
            ->assertOk()
            ->assertSee($product->name);
    }

    public function test_inactive_product_returns_404(): void
    {
        $product = $this->activeProduct(['is_active' => false]);

        $this->get(route('shop.products.show', $product))
            ->assertNotFound();
    }

    public function test_product_show_uses_slug_in_url(): void
    {
        $product = $this->activeProduct();

        $this->get('/produk/'.$product->slug)
            ->assertOk()
            ->assertSee($product->name);
    }
}