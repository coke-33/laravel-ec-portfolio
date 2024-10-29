<!-- resources/views/cart/index.blade.php -->
<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">ショッピングカート</h1>

        @if ($cartItems->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow">
                <p class="text-gray-500">カートに商品がありません。</p>
                <a href="{{ route('products.index') }}" 
                   class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                    商品一覧に戻る
                </a>
            </div>
        @else
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <ul class="divide-y divide-gray-200">
                    @foreach ($cartItems as $item)
                        <li class="p-4 flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                @if ($item->product->image_path)
                                    <img src="{{ Storage::url($item->product->image_path) }}" 
                                         alt="{{ $item->product->name }}"
                                         class="w-20 h-20 object-cover rounded">
                                @else
                                    <div class="w-20 h-20 bg-gray-200 rounded"></div>
                                @endif

                                <div>
                                    <h3 class="text-lg font-semibold">{{ $item->product->name }}</h3>
                                    <p class="text-gray-600">¥{{ number_format($item->product->price) }}</p>
                                </div>
                            </div>

                            <div class="flex items-center space-x-4">
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center">
                                    @csrf
                                    @method('PUT')
                                    <select name="quantity" onchange="this.form.submit()" 
                                            class="rounded-md border-gray-300 shadow-sm">
                                        @for ($i = 1; $i <= 10; $i++)
                                            <option value="{{ $i }}" {{ $item->quantity == $i ? 'selected' : '' }}>
                                                {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </form>

                                <form action="{{ route('cart.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-800">
                                        削除
                                    </button>
                                </form>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="p-4 bg-gray-50 border-t border-gray-200">
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-semibold">合計:</span>
                        <span class="text-2xl font-bold">¥{{ number_format($total) }}</span>
                    </div>
                    
                    <!-- 購入手続きへ進むボタンを修正 -->
                    <a href="{{ route('orders.checkout') }}" 
                       class="mt-4 block w-full bg-blue-500 hover:bg-blue-600 text-white text-center font-bold py-2 px-4 rounded">
                        購入手続きへ進む
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>