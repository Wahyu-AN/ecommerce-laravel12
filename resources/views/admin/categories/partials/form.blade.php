<div class="space-y-4">
    <div>
        <label for="name" class="block text-sm font-medium text-gray-700">
            Nama Kategori <span class="text-red-600">*</span>
        </label>
        <input type="text" name="name" id="name" value="{{ old('name', $category?->name) }}"
               required maxlength="100"
               class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
        <textarea name="description" id="description" rows="4" maxlength="1000"
                  class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $category?->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="flex items-center gap-2">
        <input type="hidden" name="is_active" value="0">
        <input type="checkbox" name="is_active" id="is_active" value="1"
               {{ old('is_active', $category?->is_active ?? true) ? 'checked' : '' }}
               class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
        <label for="is_active" class="text-sm font-medium text-gray-700">
            Kategori aktif (ditampilkan di toko)
        </label>
    </div>

    <div class="flex gap-2 pt-2">
        <button type="submit" class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white hover:bg-blue-700">
            Simpan
        </button>
        <a href="{{ route('admin.categories.index') }}" class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-300">
            Batal
        </a>
    </div>
</div>