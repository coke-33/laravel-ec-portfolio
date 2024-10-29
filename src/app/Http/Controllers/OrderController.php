<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmation;


class OrderController extends Controller
{
    public function checkout()
    {
        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'カートが空です');
        }

        return view('orders.checkout', compact('cartItems', 'total'));
    }

    public function confirm(Request $request)
    {
        $validated = $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_postal_code' => 'required|string|max:8',
            'shipping_address' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:20',
            'notes' => 'nullable|string|max:1000',
        ]);

        $user = Auth::user();
        $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();
        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        session(['shipping_info' => $validated]);

        return view('orders.confirm', compact('cartItems', 'total', 'validated'));
    }

    public function store(Request $request)
    {
        $shippingInfo = session('shipping_info');
        if (!$shippingInfo) {
            return redirect()->route('orders.checkout')
                ->with('error', '配送情報が見つかりません');
        }

        DB::beginTransaction();
        try {
            $user = Auth::user();
            $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();
            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'total_amount' => $total,
                'payment_status' => 'pending',
                'shipping_name' => $shippingInfo['shipping_name'],
                'shipping_postal_code' => $shippingInfo['shipping_postal_code'],
                'shipping_address' => $shippingInfo['shipping_address'],
                'shipping_phone' => $shippingInfo['shipping_phone'],
                'notes' => $shippingInfo['notes'] ?? null,
            ]);

            foreach ($cartItems as $cartItem) {
                $order->orderItems()->create([
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->product->price,
                ]);

                $cartItem->product->decrement('stock', $cartItem->quantity);
            }

            CartItem::where('user_id', $user->id)->delete();

            DB::commit();
            session()->forget('shipping_info');

            return redirect()->route('orders.complete', $order)
                ->with('success', 'ご注文ありがとうございます');

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('orders.checkout')
                ->with('error', '注文処理中にエラーが発生しました');
        }

        Mail::to($user->email)->queue(new OrderConfirmation($order));
    }

    public function complete(Order $order)
    {
        return view('orders.complete', compact('order'));
    }
}
