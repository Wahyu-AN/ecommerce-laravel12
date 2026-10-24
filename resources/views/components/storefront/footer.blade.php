<footer class="mt-16 bg-gray-900 text-gray-300">
    <div class="mx-auto grid max-w-7xl grid-cols-1 gap-8 px-4 py-12 sm:px-6 md:grid-cols-3 lg:px-8">
        <div>
            <h3 class="text-lg font-bold text-white">{{ config('app.name') }}</h3>
            <p class="mt-2 text-sm text-gray-400">
                Toko online terpercaya dengan produk berkualitas dan harga bersahabat.
                Belanja mudah, pengiriman cepat ke seluruh Indonesia.
            </p>
        </div>

        <div>
            <h3 class="text-lg font-bold text-white">Navigasi</h3>
            <ul class="mt-2 space-y-2 text-sm">
                <li><a href="{{ route('home') }}" class="hover:text-white">Beranda</a></li>
                <li><a href="#" class="hover:text-white">Produk</a></li>
                <li><a href="{{ route('login') }}" class="hover:text-white">Masuk</a></li>
            </ul>
        </div>

        <div>
            <h3 class="text-lg font-bold text-white">Hubungi Kami</h3>
            <ul class="mt-2 space-y-2 text-sm text-gray-400">
                <li>Email: cs@ecommerce-wahyu.id</li>
                <li>WhatsApp: 0812-3456-7890</li>
                <li>Jam operasional: 09.00 - 17.00 WIB</li>
            </ul>
        </div>
    </div>

    <div class="border-t border-gray-800 py-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} {{ config('app.name') }}. Hak cipta dilindungi.
    </div>
</footer>