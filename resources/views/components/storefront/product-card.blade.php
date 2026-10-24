@props(['product'])

<a href="{{ route('shop.products.show', $product) }}" class="group overflow-hidden rounded-lg bg-white shadow-sm transition hover:shadow-md">
    {{-- Gambar --}}
    @php $image = $product->primaryImage(); @endphp
    <div class="relative flex aspect-square items-center justify-center overflow-hidden bg-gray-200">
        @if ($image)
            <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $image->alt ?? $product->name }}"
                 class="h-full w-full object-cover transition group-hover:scale-105">
        @else
            <span class="text-sm text-gray-400">No Image</span>
        @endif

        @if ($product->is_featured)
            <span class="absolute left-2 top-2 rounded bg-amber-500 px-2 py-0.5 text-[10px] font-bold text-white">
                UNGGULAN
            </span>
        @endif
    </div>

    <div class="p-4">
        <p class="text-xs text-gray-500">{{ $product->category->name }}</p>
        <h3 class="mt-1 line-clamp-2 font-semibold text-gray-900">{{ $product->name }}</h3>

        <div class="mt-2 flex items-baseline gap-2">
            <p class="font-bold text-blue-600">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
            @if ($product->compare_price)
                <p class="text-xs text-gray-400 line-through">Rp {{ number_format($product->compare_price, 0, ',', '.') }}</p>
            @endif
        </div>

        <p class="mt-1 text-xs {{ $product->stock === 0 ? 'text-red-600 font-semibold' : 'text-gray-500' }}">
            {{ $product->stock === 0 ? 'Stok Habis' : 'Stok: '.$product->stock }}
        </p>
    </div>
</a>