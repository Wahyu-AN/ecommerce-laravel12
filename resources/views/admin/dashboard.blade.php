<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <p class="text-lg font-bold">🛡️ Selamat Datang di Panel Admin Ecommerce Wahyu!</p>
                    <p class="mt-2 text-gray-600 dark:text-gray-400">Dari sini Anda akan mengelola produk, kategori, pesanan, dan pelanggan.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>