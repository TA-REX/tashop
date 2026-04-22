<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        return view('checkout.index', compact('cart', 'total'));
    }

    public function place()
    {
        request()->validate([
            'name'    => 'required|string|max:100',
            'phone'   => 'required|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));

        $order = Order::create([
            'user_id'        => auth()->id(),
            'total'          => $total,
            'name'           => request('name'),
            'phone'          => request('phone'),
            'address'        => request('address'),
            'payment_method' => 'cod',
            'status'         => 'pending',
        ]);

        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $id,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
            Product::find($id)?->decrement('stock', $item['quantity']);
        }

        session()->forget('cart');

        return redirect()->route('orders.show', $order->id)
            ->with('success', '🎉 Order #' . $order->id . ' placed successfully! We will deliver soon.');
    }
}
