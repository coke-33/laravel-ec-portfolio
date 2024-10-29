<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Charge::create([
                'amount' => $request->amount,  // 金額を設定（例：1000 は $10.00 に相当）
                'currency' => 'jpy',           // 通貨を指定
                'source' => $request->stripeToken,
                'description' => 'Order Payment',
            ]);

            // OrderControllerのstoreメソッドを呼び出して注文を保存
            $orderController = new OrderController();
            $orderRequest = $request->merge([
                'user_id' => Auth::id()
            ]);
            $response = $orderController->store($orderRequest);

            // 正常に注文が作成されれば、注文完了画面にリダイレクト
            return $response;

        } catch (\Exception $e) {
            return redirect()->route('orders.checkout')
                ->with('error', '決済に失敗しました: ' . $e->getMessage());
        }
    }
}
