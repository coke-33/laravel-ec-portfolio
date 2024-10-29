<!-- resources/views/orders/checkout.blade.php -->
<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-2">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">配送情報入力</h3>
                </div>
                
                <form action="{{ route('orders.confirm') }}" method="POST" class="mt-5">
                    @csrf
                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="col-span-6 sm:col-span-4">
                                    <label for="shipping_name" class="block text-sm font-medium text-gray-700">お名前</label>
                                    <input type="text" name="shipping_name" id="shipping_name" value="{{ old('shipping_name') }}"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('shipping_name')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700">郵便番号</label>
                                    <input type="text" name="shipping_postal_code" id="shipping_postal_code" value="{{ old('shipping_postal_code') }}"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('shipping_postal_code')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6">
                                    <label for="shipping_address" class="block text-sm font-medium text-gray-700">住所</label>
                                    <input type="text" name="shipping_address" id="shipping_address" value="{{ old('shipping_address') }}"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('shipping_address')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="shipping_phone" class="block text-sm font-medium text-gray-700">電話番号</label>
                                    <input type="text" name="shipping_phone" id="shipping_phone" value="{{ old('shipping_phone') }}"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    @error('shipping_phone')
                                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-span-6">
                                    <label for="notes" class="block text-sm font-medium text-gray-700">備考</label>
                                    <textarea name="notes" id="notes" rows="3"
                                        class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">{{ old('notes') }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                確認画面へ
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">注文内容</h3>
                    <div class="mt-5 bg-white shadow overflow-hidden sm:rounded-md">
                        <ul class="divide-y divide-gray-200">
                            @foreach ($cartItems as $item)
                                <li class="px-4 py-4">
                                    <div class="flex items-center space-x-4">
                                        @if ($item->product->image_path)
                                            <img src="{{ Storage::url($item->product->image_path) }}" 
                                                alt="{{ $item->product->name }}"
                                                class="w-16 h-16 object-cover rounded">
                                        @else
                                            <div class="w-16 h-16 bg-gray-200 rounded"></div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 truncate">
                                                {{ $item->product->name }}
                                            </p>
                                            <p class="text-sm text-gray-500">
                                                数量: {{ $item->quantity }}
                                            </p>
                                            <p class="text-sm font-medium text-gray-900">
                                                ¥{{ number_format($item->product->price * $item->quantity) }}
                                            </p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                        <div class="px-4 py-4 bg-gray-50">
                            <div class="flex justify-between items-center">
                                <span class="text-base font-medium text-gray-900">合計:</span>
                                <span class="text-xl font-bold text-gray-900">¥{{ number_format($total) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>