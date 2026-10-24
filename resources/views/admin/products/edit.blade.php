<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">{{ __('Edit Produk: '.$product->name) }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-4xl sm:px-6 lg:px-8">
            @include('admin.partials.flash')

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('admin.products.update', $product) }}" enctype="multipart/form-data" class="space-y-6 p-6">
                    @csrf
                    @method('PUT')
                    @include('admin.products.partials.fields', ['product' => $product])

                    @if ($product->images->isNotEmpty())
                        <div>
                            <span class="block text-sm font-medium text-gray-700">Gambar Saat Ini</span>
                            <div class="mt-2 grid grid-cols-3 gap-4 md:grid-cols-5">
                                @foreach ($product->images as $image)
                                    <div>
                                        <div class="relative">
                                            <img src="{{ asset('storage/'.$image->path) }}" alt="{{ $image->alt ?? $product->name }}" class="h-24 w-full rounded object-cover">
                                            @if ($image->is_primary)
                                                <span class="absolute left-1 top-1 rounded bg-blue-600 px-1.5 py-0.5 text-[10px] font-bold text-white">UTAMA</span>
                                            @endif
                                        </div>
                                        <label class="mt-1 flex items-center gap-1 text-xs text-red-600">
                                            <input type="checkbox" name="delete_images[]" value="{{ $image->id }}"
                                                   class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                                            Hapus
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div>
                        <label for="images" class="block text-sm font-medium text-gray-700">
                            Tambah Gambar Baru
                            <span class="text-xs text-gray-400">(maks 5 gambar; jpg, png, webp; maks 2MB per gambar)</span>
                        </label>
                        <input type="file" name="images[]" id="images" multiple accept="image/jpeg,image/png,image/webp"
                               class="mt-1 block w-full text-sm text-gray-600 file:mr-3 file:rounded-md file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100">
                        <x-input-error :messages="$errors->get('images')" class="mt-2" />
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">Simpan Perubahan</button>
                        <a href="{{ route('admin.products.index') }}" class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-300">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>