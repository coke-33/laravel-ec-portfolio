<!-- resources/views/orders/complete.blade.php -->
<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white shadow sm:rounded-lg">
                <div class="px-4 py-5 sm:p-6 text-center">
                    <h3 class="text-lg leading-6 font-medium text-gray-900">
                        ご注文ありがとうございます
                    </h3>
                    <div class="mt-2 max-w-xl text-sm text-gray-500">
                        <p>注文番号: {{ $order->order_number }}</p>
                        <p class="mt-1">内容を確認次第、メールにてご連絡いたします。</p>
                    </div>
                    <div class="mt-5">
                        <a href="{{ route('products.index') }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            商品一覧に戻る
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>