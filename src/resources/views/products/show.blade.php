<!-- resources/views/products/show.blade.php -->
<x-app-layout>
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="md:flex">
                <div class="md:w-1/2">
                    @if ($product->image_path)
                        <img src="{{ Storage::url($product->image_path) }}" alt="{{ $product->name }}" 
                             class="w-full h-96 object-cover">
                    @else
                        <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">No Image</span>
                        </div>
                    @endif
                </div>
                
                <div class="md:w-1/2 p-8">
                    <div class="flex justify-between items-start">
                        <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                        @auth
                            <a href="{{ route('products.edit', $product) }}" 
                               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded">
                                編集
                            </a>
                        @endauth
                    </div>
                    
                    <p class="text-gray-600 mb-6">{{ $product->description }}</p>
                    
                    <div class="mb-6">
                        <span class="text-2xl font-bold text-gray-800">¥{{ number_format($product->price) }}</span>
                    </div>
                    
                    @if ($product->stock > 0)
                        <form action="{{ route('cart.store', $product) }}" method="POST">
                            @csrf
                            <div class="flex items-center gap-4 mb-4">
                                <label for="quantity" class="font-medium">数量:</label>
                                <select name="quantity" id="quantity" 
                                        class="rounded-md border-gray-300 shadow-sm">
                                    @for ($i = 1; $i <= min(10, $product->stock); $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <button type="submit" 
                                    class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-6 rounded">
                                カートに追加
                            </button>
                        </form>
                    @else
                        <button class="w-full bg-gray-300 text-gray-500 font-bold py-3 px-6 rounded cursor-not-allowed">
                            在庫切れ
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>