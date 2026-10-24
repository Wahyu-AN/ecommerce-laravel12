<x-layouts.storefront :title="$product->name">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        {{-- Breadcrumb --}}
        <nav class="mb-6 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
            <span class="mx-2">/</span>
            <a href="{{ route('shop.products.index') }}" class="hover:text-blue-600">Produk</a>
            <span class="mx-2">/</span>
            <span class="text-gray-900">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 gap-8 md:grid-cols-2">
            {{-- Galeri Gambar --}}
            <div>
                @php $primary = $product->primaryImage(); @endphp
                @if ($primary)
                    <div class="aspect-square overflow-hidden rounded-lg bg-gray-100">
                        <img src="{{ asset('storage/'.$primary->path) }}" alt="{{ $primary->alt ?? $product->name }}"
                             class="h-full w-full object-cover">
                    </div>
                @else
                    <div class="flex aspect-square items-center justify-center rounded-lg bg-gray-100">
                        <span class="text-gray-400">Tidak ada gambar</span>
                    </div>
                @endif

                @if ($product->images->count() > 1)
                    <div class="mt-4 grid grid-cols-4 gap-2">
                        @foreach ($product->images as $image)
                            <div class="aspect-square overflow-hidden rounded border-2 {{ $image->is_primary ? 'border-blue-600' : 'border-transparent' }}">
                                <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $image->alt ?? $product->name }}"
                                     class="h-full w-full object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            {{-- Informasi Produk --}}
            <div>
                <p class="text-sm font-semibold text-blue-600">{{ $product->category->name }}</p>
                <h1 class="mt-2 text-3xl font-bold text-gray-900">{{ $product->name }}</h1>

                <div class="mt-4 flex items-baseline gap-3">
                    <p class="text-3xl font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    @if ($product->compare_price)
                        <p class="text-lg text-gray-400 line-through">Rp {{ number_format($product->compare_price, 0, ',', '.') }}</p>
                    @endif
                </div>

                <div class="mt-4 flex items-center gap-2">
                    <span class="text-sm font-semibold {{ $product->stock === 0 ? 'text-red-600' : 'text-green-600' }}">
                        {{ $product->stock === 0 ? 'Stok Habis' : 'Tersedia: '.$product->stock }}
                    </span>
                </div>

                @if ($product->description)
                    <div class="mt-6 border-t border-gray-200 pt-6">
                        <h2 class="text-lg font-semibold text-gray-900">Deskripsi</h2>
                        <div class="mt-3 whitespace-pre-line text-gray-700">
                            {{ $product->description }}
                        </div>
                    </div>
                @endif

                {{-- Tombol Aksi (Fase 6: Cart) --}}
                <div class="mt-8 border-t border-gray-200 pt-6">
                    @if ($product->stock > 0)
                        <button type="button" disabled
                                class="w-full rounded-lg bg-gray-300 px-6 py-3 text-sm font-semibold text-white cursor-not-allowed">
                            Tambah ke Keranjang (Segera Hadir)
                        </button>
                    @else
                        <button type="button" disabled
                                class="w-full rounded-lg bg-red-300 px-6 py-3 text-sm font-semibold text-white cursor-not-allowed">
                            Stok Habis
                        </button>
                    @endif
                    <p class="mt-2 text-center text-xs text-gray-500">Fitur keranjang akan tersedia di fase berikutnya.</p>
                </div>
            </div>
        </div>

        {{-- Produk Terkait --}}
        @if ($relatedProducts->isNotEmpty())
            <section class="mt-16">
                <h2 class="text-2xl font-bold text-gray-900">Produk Terkait</h2>
                <div class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($relatedProducts as $related)
                        <x-storefront.product-card :product="$related" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-layouts.storefront>