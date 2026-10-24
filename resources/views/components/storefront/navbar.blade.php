<nav x-data="{ open: false }" class="sticky top-0 z-40 bg-white shadow-sm">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 items-center justify-between">
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="text-xl font-extrabold text-blue-600">
                {{ config('app.name') }}
            </a>

            {{-- Menu desktop --}}
            <div class="hidden items-center gap-6 md:flex">
                <a href="{{ route('home') }}" class="font-medium text-gray-700 hover:text-blue-600">Beranda</a>
                <a href="{{ route('shop.products.index') }}" class="font-medium text-gray-700 hover:text-blue-600">Produk</a>

                @auth
                    <a href="{{ route('dashboard') }}" class="font-medium text-gray-700 hover:text-blue-600">Dashboard</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="font-medium text-gray-700 hover:text-red-600">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="font-medium text-gray-700 hover:text-blue-600">Masuk</a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-blue-600 px-4 py-2 font-semibold text-white hover:bg-blue-700">Daftar</a>
                @endauth
            </div>

            {{-- Tombol hamburger (mobile) --}}
            <button type="button"
                    @click="open = !open"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-700 hover:bg-gray-100 md:hidden">
                <span class="sr-only">Buka menu utama</span>
                <svg x-show="!open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                <svg x-show="open" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    {{-- Menu mobile --}}
    <div x-show="open" x-transition.origin.top class="border-t border-gray-100 bg-white md:hidden">
        <div class="space-y-1 px-4 py-3">
            <a href="{{ route('home') }}" class="block rounded-md px-3 py-2 font-medium text-gray-700 hover:bg-gray-100">Beranda</a>
            <a href="{{ route('shop.products.index') }}" class="block rounded-md px-3 py-2 font-medium text-gray-700 hover:bg-gray-100">Produk</a>

            @auth
                <a href="{{ route('dashboard') }}" class="block rounded-md px-3 py-2 font-medium text-gray-700 hover:bg-gray-100">Dashboard</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full rounded-md px-3 py-2 text-left font-medium text-red-600 hover:bg-gray-100">Keluar</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block rounded-md px-3 py-2 font-medium text-gray-700 hover:bg-gray-100">Masuk</a>
                <a href="{{ route('register') }}" class="block rounded-md px-3 py-2 font-medium text-blue-600 hover:bg-gray-100">Daftar</a>
            @endauth
        </div>
    </div>
</nav>