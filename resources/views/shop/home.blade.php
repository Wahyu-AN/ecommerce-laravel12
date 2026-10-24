<x-layouts.storefront title="Beranda">
    {{-- Hero Banner --}}
    <section class="bg-blue-600 text-white">
        <div class="mx-auto max-w-7xl px-4 py-16 text-center sm:px-6 md:py-24 lg:px-8">
            <h1 class="text-3xl font-extrabold md:text-5xl">Belanja Mudah, Harga Bersahabat</h1>
            <p class="mt-4 text-blue-100 md:text-lg">
                Temukan ribuan produk favorit Anda dengan harga terbaik dan pengiriman cepat ke seluruh Indonesia.
            </p>
            <a href="#" class="mt-8 inline-block rounded-lg bg-white px-6 py-3 font-semibold text-blue-600 hover:bg-blue-50">
                Mulai Belanja
            </a>
        </div>
    </section>

    {{-- Kategori Pilihan --}}
    <section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900">Kategori Pilihan</h2>
        <div class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-4">
            @foreach ($demoCategories as $category)
                <a href="#" class="rounded-lg bg-white p-6 text-center font-semibold text-gray-700 shadow-sm transition hover:shadow-md hover:text-blue-600">
                    {{ $category }}
                </a>
            @endforeach
        </div>
    </section>

    {{-- Produk Unggulan --}}
    <section class="mx-auto max-w-7xl px-4 pb-16 sm:px-6 lg:px-8">
        <h2 class="text-2xl font-bold text-gray-900">Produk Unggulan</h2>
        <div class="mt-6 grid grid-cols-2 gap-4 md:grid-cols-3 lg:grid-cols-4">
            @foreach ($demoProducts as $product)
                <x-storefront.product-card
                    :name="$product['name']"
                    :price="$product['price']"
                    :category="$product['category']"
                />
            @endforeach
        </div>
    </section>
</x-layouts.storefront>