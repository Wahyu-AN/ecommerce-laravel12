<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ __('Produk') }}</h2>
            <a href="{{ route('admin.products.create') }}"
               class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
                + Tambah Produk
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            @include('admin.partials.flash')

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    {{-- Filter --}}
                    <form method="GET" action="{{ route('admin.products.index') }}" class="mb-4 grid grid-cols-1 gap-2 md:grid-cols-[1fr_220px_auto]">
                        <input type="text" name="q" value="{{ $search }}" placeholder="Cari nama atau SKU..."
                               class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        <select name="category" class="rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Semua Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected($categoryId === $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="rounded-md bg-gray-800 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Filter</button>
                    </form>

                    {{-- Tabel --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                            <thead class="bg-gray-50 text-left text-xs font-semibold uppercase text-gray-600">
                                <tr>
                                    <th class="px-4 py-3">#</th>
                                    <th class="px-4 py-3">Produk</th>
                                    <th class="px-4 py-3">Kategori</th>
                                    <th class="px-4 py-3">Harga</th>
                                    <th class="px-4 py-3">Stok</th>
                                    <th class="px-4 py-3">Status</th>
                                    <th class="px-4 py-3 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 bg-white">
                                @forelse ($products as $product)
                                    <tr>
                                        <td class="px-4 py-3">{{ $loop->iteration + ($products->currentPage() - 1) * $products->perPage() }}</td>
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-3">
                                                @php $image = $product->primaryImage(); @endphp
                                                @if ($image)
                                                    <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $image->alt ?? $product->name }}" class="h-12 w-12 rounded object-cover">
                                                @else
                                                    <div class="flex h-12 w-12 items-center justify-center rounded bg-gray-200 text-[10px] text-gray-400">No img</div>
                                                @endif
                                                <div>
                                                    <p class="font-medium text-gray-900">{{ $product->name }}</p>
                                                    <p class="text-xs text-gray-500">
                                                        {{ $product->sku ?? '-' }}
                                                        @if ($product->is_featured)
                                                            • <span class="font-semibold text-amber-600">Unggulan</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">{{ $product->category->name }}</td>
                                        <td class="px-4 py-3">
                                            <p class="font-semibold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                            @if ($product->compare_price)
                                                <p class="text-xs text-gray-400 line-through">Rp {{ number_format($product->compare_price, 0, ',', '.') }}</p>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <span class="@if ($product->stock === 0) font-semibold text-red-600 @elseif ($product->stock < 10) font-semibold text-amber-600 @else text-gray-700 @endif">
                                                {{ $product->stock }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if ($product->is_active)
                                                <span class="rounded-full bg-green-100 px-2 py-1 text-xs font-semibold text-green-700">Aktif</span>
                                            @else
                                                <span class="rounded-full bg-gray-200 px-2 py-1 text-xs font-semibold text-gray-600">Nonaktif</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex justify-end gap-2">
                                                <a href="{{ route('admin.products.edit', $product) }}"
                                                   class="rounded-md bg-amber-500 px-3 py-1.5 text-xs font-semibold text-white hover:bg-amber-600">Edit</a>
                                                <form method="POST" action="{{ route('admin.products.destroy', $product) }}"
                                                      onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="rounded-md bg-red-600 px-3 py-1.5 text-xs font-semibold text-white hover:bg-red-700">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">Belum ada produk.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">{{ $products->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>