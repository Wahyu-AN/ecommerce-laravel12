<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Kategori: '.$category->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-3xl sm:px-6 lg:px-8">
            @include('admin.partials.flash')

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="p-6">
                    @csrf
                    @method('PUT')
                    @include('admin.categories.partials.form', ['category' => $category])
                </form>
            </div>
        </div>
    </div>
</x-app-layout>