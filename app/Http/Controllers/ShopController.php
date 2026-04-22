<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class ShopController extends Controller
{
    public function index()
    {
        $query = Product::where('is_active', true)->with('category');

        if (request('search')) {
            $query->where('name', 'like', '%' . request('search') . '%');
        }

        if (request('category')) {
            $query->where('category_id', request('category'));
        }

        if (request('sort') === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif (request('sort') === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest();
        }

        $products = $query->paginate(9)->withQueryString();
        $categories = Category::all();

        return view('shop.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::where('slug', $slug)->with('category')->firstOrFail();
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->take(4)->get();
        return view('shop.show', compact('product', 'related'));
    }
}
