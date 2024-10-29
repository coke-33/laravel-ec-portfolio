<x-mail::message>
# ご注文ありがとうございます！

{{ $order->shipping_name }} 様

ご注文が完了しました。以下がご注文の詳細です。

## 注文情報
- **注文番号**: {{ $order->order_number }}
- **合計金額**: ¥{{ number_format($order->total_amount) }}
- **配送先**: {{ $order->shipping_address }}
- **郵便番号**: {{ $order->shipping_postal_code }}
- **電話番号**: {{ $order->shipping_phone }}

@if($order->notes)
- **備考**: {{ $order->notes }}
@endif

<x-mail::button :url="route('orders.history')">
注文履歴を確認する
</x-mail::button>

今後ともよろしくお願いいたします。

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

