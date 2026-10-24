@props(['name', 'price', 'category'])

<div class="overflow-hidden rounded-lg bg-white shadow-sm transition hover:shadow-md">
    {{-- Placeholder gambar, Fase 4 diganti gambar asli --}}
    <div class="flex aspect-square items-center justify-center bg-gray-200">
        <span class="text-sm text-gray-400">Gambar Produk</span>
    </div>

    <div class="p-4">
        <p class="text-xs text-gray-500">{{ $category }}</p>
        <h3 class="mt-1 truncate font-semibold text-gray-900">{{ $name }}</h3>
        <p class="mt-1 font-bold text-blue-600">Rp {{ number_format($price, 0, ',', '.') }}</p>
    </div>
</div>
