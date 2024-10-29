<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow overflow-hidden sm:rounded-lg">
                <div class="px-4 py-5 sm:px-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">注文内容の確認</h3>
                </div>
                
                <!-- 配送情報 -->
                <div class="border-t border-gray-200">
                    <dl>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">お名前</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $validated['shipping_name'] }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">郵便番号</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $validated['shipping_postal_code'] }}</dd>
                        </div>
                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">住所</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $validated['shipping_address'] }}</dd>
                        </div>
                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                            <dt class="text-sm font-medium text-gray-500">電話番号</dt>
                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $validated['shipping_phone'] }}</dd>
                        </div>
                        @if(isset($validated['notes']))
                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">備考</dt>
                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">{{ $validated['notes'] }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>

                <!-- 注文商品 -->
                <div class="px-4 py-5 sm:px-6">
                    <h4 class="text-lg font-medium text-gray-900">注文商品</h4>
                    <div class="mt-4">
                        <ul class="divide-y divide-gray-200">
                            @foreach ($cartItems as $item)
                                <li class="py-4 flex items-center">
                                    @if ($item->product->image_path)
                                        <img src="{{ Storage::url($item->product->image_path) }}" 
                                             alt="{{ $item->product->name }}"
                                             class="w-16 h-16 object-cover rounded">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded"></div>
                                    @endif
                                    <div class="ml-4 flex-1">
                                        <p class="text-sm font-medium text-gray-900">{{ $item->product->name }}</p>
                                        <p class="text-sm text-gray-500">数量: {{ $item->quantity }}</p>
                                        <p class="text-sm font-medium text-gray-900">¥{{ number_format($item->product->price * $item->quantity) }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- 合計金額 -->
                <div class="bg-gray-50 px-4 py-5 sm:px-6">
                    <div class="flex justify-between items-center">
                        <span class="text-base font-medium text-gray-900">合計:</span>
                        <span class="text-xl font-bold text-gray-900">¥{{ number_format($total) }}</span>
                    </div>
                </div>

                <!-- 注文ボタン -->
                <div class="px-4 py-5 bg-gray-50 sm:px-6 flex justify-between">
                    <form id="payment-form" action="{{ route('orders.processPayment') }}" method="POST">
                        @csrf
                        <input type="hidden" name="amount" value="{{ $total * 100 }}"> <!-- Stripeは小数を扱わないので、金額は「円」に合わせる必要がある場合100倍 -->
                
                        <script
                            src="https://checkout.stripe.com/checkout.js"
                            class="stripe-button"
                            data-key="{{ env('STRIPE_KEY') }}"
                            data-amount="{{ $total * 100 }}"
                            data-name="ECサイト"
                            data-description="注文内容"
                            data-currency="jpy"
                            data-locale="ja">
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>