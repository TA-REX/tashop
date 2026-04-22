<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = array_sum(array_map(fn($i) => $i['price'] * $i['quantity'], $cart));
        return view('cart.index', compact('cart', 'total'));
    }

    public function add()
    {
        $product = Product::findOrFail(request('product_id'));

        if ($product->stock < 1) {
            return back()->with('error', 'Product is out of stock!');
        }

        $cart = session()->get('cart', []);
        $id = $product->id;

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name'     => $product->name,
                'price'    => $product->sale_price ?? $product->price,
                'quantity' => 1,
                'image'    => $product->image,
                'slug'     => $product->slug,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('success', '✅ ' . $product->name . ' added to cart!');
    }

    public function update($id)
    {
        $cart = session()->get('cart', []);
        $qty = (int) request('quantity');

        if ($qty < 1) {
            unset($cart[$id]);
        } elseif (isset($cart[$id])) {
            $cart[$id]['quantity'] = $qty;
        }

        session()->put('cart', $cart);
        return back()->with('success', 'Cart updated.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return back()->with('success', 'Item removed from cart.');
    }
}
