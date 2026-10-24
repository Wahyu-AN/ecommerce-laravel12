<div class="space-y-4">
    <div>
        <label for="category_id" class="block text-sm font-medium text-gray-700">
            Kategori <span class="text-red-600">*</span>
        </label>
        <select name="category_id" id="category_id" required
                class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((int) old('category_id', $product?->category_id) === $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                Nama Produk <span class="text-red-600">*</span>
            </label>
            <input type="text" name="name" id="name" value="{{ old('name', $product?->name) }}" required maxlength="150"
                   class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>
        <div>
            <label for="sku" class="block text-sm font-medium text-gray-700">
                SKU <span class="text-xs text-gray-400">(opsional)</span>
            </label>
            <input type="text" name="sku" id="sku" value="{{ old('sku', $product?->sku) }}" maxlength="50"
                   class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <x-input-error :messages="$errors->get('sku')" class="mt-2" />
        </div>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <div>
            <label for="price" class="block text-sm font-medium text-gray-700">
                Harga (Rp) <span class="text-red-600">*</span>
            </label>
            <input type="number" name="price" id="price" value="{{ old('price', $product?->price) }}" required min="0" step="1"
                   class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>
        <div>
            <label for="compare_price" class="block text-sm font-medium text-gray-700">Harga Coret (Rp)</label>
            <input type="number" name="compare_price" id="compare_price" value="{{ old('compare_price', $product?->compare_price) }}" min="0" step="1"
                   class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <x-input-error :messages="$errors->get('compare_price')" class="mt-2" />
        </div>
        <div>
            <label for="stock" class="block text-sm font-medium text-gray-700">
                Stok <span class="text-red-600">*</span>
            </label>
            <input type="number" name="stock" id="stock" value="{{ old('stock', $product?->stock ?? 0) }}" required min="0" step="1"
                   class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            <x-input-error :messages="$errors->get('stock')" class="mt-2" />
        </div>
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" id="description" rows="5" maxlength="5000"
                  class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $product?->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="flex flex-col gap-3 sm:flex-row sm:gap-6">
        <div class="flex items-center gap-2">
            <input type="hidden" name="is_active" value="0">
            <input type="checkbox" name="is_active" id="is_active" value="1"
                   {{ old('is_active', $product?->is_active ?? true) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <label for="is_active" class="text-sm font-medium text-gray-700">Aktif dijual</label>
        </div>
        <div class="flex items-center gap-2">
            <input type="hidden" name="is_featured" value="0">
            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                   {{ old('is_featured', $product?->is_featured ?? false) ? 'checked' : '' }}
                   class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
            <label for="is_featured" class="text-sm font-medium text-gray-700">Produk unggulan</label>
        </div>
    </div>
</div>