<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProductManagementTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    public function test_guest_cannot_access_product_index(): void
    {
        $this->get(route('admin.products.index'))->assertRedirect(route('login'));
    }

    public function test_customer_cannot_access_product_index(): void
    {
        $customer = User::factory()->create(['role' => 'customer']);

        $this->actingAs($customer)->get(route('admin.products.index'))->assertForbidden();
    }

    public function test_admin_can_create_product_with_image(): void
    {
        Storage::fake('public');

        $category = Category::create(['name' => 'Elektronik']);

        $this->actingAs($this->admin())
            ->post(route('admin.products.store'), [
                'category_id' => $category->id,
                'name' => 'Headset Bluetooth',
                'price' => 250000,
                'stock' => 10,
                'is_active' => 1,
                'images' => [UploadedFile::fake()->image('headset.jpg')],
            ])
            ->assertRedirect(route('admin.products.index'));

        $product = Product::where('name', 'Headset Bluetooth')->first();

        $this->assertNotNull($product);
        $this->assertSame('headset-bluetooth', $product->slug);
        $this->assertSame(1, $product->images()->count());
        $this->assertTrue($product->images()->first()->is_primary);
    }

    public function test_product_price_cannot_be_negative(): void
    {
        $category = Category::create(['name' => 'Elektronik']);

        $this->actingAs($this->admin())
            ->post(route('admin.products.store'), [
                'category_id' => $category->id,
                'name' => 'Produk Rugi',
                'price' => -100,
                'stock' => 5,
            ])
            ->assertSessionHasErrors('price');
    }

    public function test_category_with_products_cannot_be_deleted(): void
    {
        $category = Category::create(['name' => 'Elektronik']);

        Product::create([
            'category_id' => $category->id,
            'name' => 'Headset',
            'price' => 100000,
            'stock' => 1,
        ]);

        $this->actingAs($this->admin())
            ->delete(route('admin.categories.destroy', $category))
            ->assertRedirect(route('admin.categories.index'))
            ->assertSessionHas('error');

        $this->assertDatabaseHas('categories', ['id' => $category->id]);
    }
}