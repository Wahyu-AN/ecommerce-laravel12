<x-layouts.storefront title="Beranda">
    {{-- Hero Banner --}}
    <section class="bg-blue-600 text-white">
        <div class="mx-auto max-w-7xl px-4 py-16 text-center sm:px-6 md:py-24 lg:px-8">
            <h1 class="text-3xl font-extrabold md:text-5xl">Belanja Mudah, Harga Bersahabat</h1>
            <p class="mt-4 text-blue-100 md:text-lg">
                Temukan ribuan produk favorit Anda dengan harga terbaik dan pengiriman cepat ke seluruh Indonesia.
            </p>
            <a href="{{ route('shop.products.index') }}" class="mt-8 inline-block rounded-lg bg-white px-6 py-3 font-semibold text-blue-600 hover:bg-blue-50">
                Mulai Belanja
            </a>
        </div>
    </section>

    {{-- Kategori Pilihan --}}
    @if ($categories->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900">Kategori Pilihan</h2>
            <div class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-4">
                @foreach ($categories as $category)
                    <a href="{{ route('shop.products.index', ['category' => $category->id]) }}"
                       class="rounded-lg bg-white p-6 text-center font-semibold text-gray-700 shadow-sm transition hover:shadow-md hover:text-blue-600">
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Produk Unggulan --}}
    @if ($featuredProducts->isNotEmpty())
        <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900">Produk Unggulan</h2>
                <a href="{{ route('shop.products.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">
                    Lihat Semua →
                </a>
            </div>
            <div class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
                @foreach ($featuredProducts as $product)
                    <x-storefront.product-card :product="$product" />
                @endforeach
            </div>
        </section>
    @endif
</x-layouts.storefront>