<!-- resources/views/products/edit.blade.php -->
<x-app-layout>
    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <h1 class="text-2xl font-bold mb-6">商品編集</h1>

        <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <x-input-label for="name" value="商品名" />
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                    :value="old('name', $product->name)" required />
                <x-input-error class="mt-2" :messages="$errors->get('name')" />
            </div>

            <div>
                <x-input-label for="description" value="商品説明" />
                <textarea id="description" name="description"
                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                    rows="4" required>{{ old('description', $product->description) }}</textarea>
                <x-input-error class="mt-2" :messages="$errors->get('description')" />
            </div>

            <div>
                <x-input-label for="price" value="価格" />
                <x-text-input id="price" name="price" type="number" class="mt-1 block w-full"
                    :value="old('price', $product->price)" required />
                <x-input-error class="mt-2" :messages="$errors->get('price')" />
            </div>

            <div>
                <x-input-label for="stock" value="在庫数" />
                <x-text-input id="stock" name="stock" type="number" class="mt-1 block w-full"
                    :value="old('stock', $product->stock)" required />
                <x-input-error class="mt-2" :messages="$errors->get('stock')" />
            </div>

            <div>
                <x-input-label for="image" value="商品画像" />
                @if ($product->image_path)
                    <div class="mt-2">
                        <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover">
                    </div>
                @endif
                <input type="file" id="image" name="image" 
                    class="mt-2 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" />
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>

            <div class="flex items-center gap-4">
                <x-primary-button>更新</x-primary-button>
                <a href="{{ route('products.show', $product) }}" class="text-gray-600 hover:text-gray-900">キャンセル</a>
            </div>
        </form>
    </div>
</x-app-layout>