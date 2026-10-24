<x-layouts.storefront title="Produk">
    <div class="bg-gray-100 py-8">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-900">Semua Produk</h1>
            <p class="mt-2 text-gray-600">Temukan produk favorit Anda di sini.</p>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-[240px_1fr]">
            {{-- Sidebar Filter --}}
            <aside>
                <form method="GET" action="{{ route('shop.products.index') }}" class="space-y-6">
                    {{-- Pencarian --}}
                    <div>
                        <label for="q" class="block text-sm font-semibold text-gray-700">Cari Produk</label>
                        <input type="text" name="q" id="q" value="{{ $search }}" placeholder="Nama atau SKU..."
                               class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    {{-- Kategori --}}
                    <div>
                        <span class="block text-sm font-semibold text-gray-700">Kategori</span>
                        <div class="mt-2 space-y-2">
                            <label class="flex items-center gap-2 text-sm">
                                <input type="radio" name="category" value=""
                                       {{ !$categoryId ? 'checked' : '' }}
                                       class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                <span>Semua</span>
                            </label>
                            @foreach ($categories as $category)
                                <label class="flex items-center gap-2 text-sm">
                                    <input type="radio" name="category" value="{{ $category->id }}"
                                           {{ $categoryId === $category->id ? 'checked' : '' }}
                                           class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                    <span>{{ $category->name }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    {{-- Sorting --}}
                    <div>
                        <label for="sort" class="block text-sm font-semibold text-gray-700">Urutkan</label>
                        <select name="sort" id="sort" class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="price_low" {{ $sort === 'price_low' ? 'selected' : '' }}>Harga: Rendah ke Tinggi</option>
                            <option value="price_high" {{ $sort === 'price_high' ? 'selected' : '' }}>Harga: Tinggi ke Rendah</option>
                        </select>
                    </div>

                    <button type="submit" class="w-full rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                        Terapkan Filter
                    </button>

                    @if ($search || $categoryId || $sort !== 'latest')
                        <a href="{{ route('shop.products.index') }}" class="block text-center text-sm text-gray-600 hover:text-blue-600">
                            Reset Filter
                        </a>
                    @endif
                </form>
            </aside>

            {{-- Daftar Produk --}}
            <div>
                <p class="mb-4 text-sm text-gray-600">
                    Menampilkan {{ $products->firstItem() ?? 0 }} - {{ $products->lastItem() ?? 0 }} dari {{ $products->total() }} produk
                </p>

                @if ($products->isEmpty())
                    <div class="rounded-lg bg-white p-12 text-center shadow-sm">
                        <p class="text-gray-500">Tidak ada produk yang ditemukan.</p>
                        <a href="{{ route('shop.products.index') }}" class="mt-4 inline-block text-sm font-semibold text-blue-600 hover:text-blue-700">
                            Reset filter
                        </a>
                    </div>
                @else
                    <div class="grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-3">
                        @foreach ($products as $product)
                            <x-storefront.product-card :product="$product" />
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.storefront>