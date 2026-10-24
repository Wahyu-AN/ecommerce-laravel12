<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductStoreRequest;
use App\Http\Requests\Admin\ProductUpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Daftar produk + pencarian + filter kategori.
     */
    public function index(Request $request): View
    {
        $search = trim((string) $request->query('q'));
        $categoryId = $request->integer('category') ?: null;

        $products = Product::query()
            ->with(['category', 'images'])
            ->when($search, fn ($q) => $q->where(fn ($w) => $w
                ->where('name', 'like', '%'.$search.'%')
                ->orWhere('sku', 'like', '%'.$search.'%')))
            ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId))
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        return view('admin.products.index', [
            'products' => $products,
            'categories' => Category::orderBy('name')->get(),
            'search' => $search,
            'categoryId' => $categoryId,
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function store(ProductStoreRequest $request): RedirectResponse
    {
        $product = DB::transaction(function () use ($request) {
            $product = Product::create($this->productData($request));

            if ($request->hasFile('images')) {
                $this->uploadImages($product, $request->file('images'));
            }

            return $product;
        });

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk "'.$product->name.'" berhasil ditambahkan.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => $product->load('images'),
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        DB::transaction(function () use ($request, $product) {
            $product->update($this->productData($request));

            $deleteIds = (array) $request->input('delete_images', []);

            if ($deleteIds !== []) {
                $images = $product->images()->whereIn('id', $deleteIds)->get();

                foreach ($images as $image) {
                    Storage::disk('public')->delete($image->path);
                    $image->delete();
                }
            }

            if ($request->hasFile('images')) {
                $this->uploadImages($product, $request->file('images'));
            }

            $this->ensurePrimaryImage($product);
        });

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk "'.$product->name.'" berhasil diperbarui.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        DB::transaction(function () use ($product) {
            foreach ($product->images as $image) {
                Storage::disk('public')->delete($image->path);
            }

            $product->delete(); // soft delete
        });

        return redirect()
            ->route('admin.products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }

    /**
     * Ambil hanya field produk yang tervalidasi.
     */
    private function productData(ProductStoreRequest|ProductUpdateRequest $request): array
    {
        return $request->safe()->only([
            'category_id',
            'name',
            'sku',
            'description',
            'price',
            'compare_price',
            'stock',
            'is_active',
            'is_featured',
        ]);
    }

    /**
     * Simpan gambar ke storage public dan set primary otomatis.
     */
    private function uploadImages(Product $product, array $files): void
    {
        foreach ($files as $file) {
            $product->images()->create([
                'path' => $file->store('products', 'public'),
                'alt' => $product->name,
                'is_primary' => false,
            ]);
        }

        $this->ensurePrimaryImage($product);
    }

    /**
     * Pastikan selalu ada satu gambar utama.
     */
    private function ensurePrimaryImage(Product $product): void
    {
        if ($product->images()->where('is_primary', true)->exists()) {
            return;
        }

        $first = $product->images()->orderBy('id')->first();

        if ($first !== null) {
            $first->update(['is_primary' => true]);
        }
    }
}