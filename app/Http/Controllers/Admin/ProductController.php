<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(15);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store()
    {
        $data = request()->validate([
            'name'        => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        $data['slug']        = Str::slug($data['name']) . '-' . uniqid();
        $data['description'] = request('description');
        $data['sale_price']  = request('sale_price') ?: null;
        $data['is_active']   = request()->has('is_active') ? 1 : 0;

        if (request()->hasFile('image')) {
            $data['image'] = request()->file('image')->store('products', 'public');
        }

        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', '✅ Product added successfully!');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Product $product)
    {
        $data = request()->validate([
            'name'        => 'required|string|max:200',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        $data['slug']        = Str::slug($data['name']) . '-' . $product->id;
        $data['description'] = request('description');
        $data['sale_price']  = request('sale_price') ?: null;
        $data['is_active']   = request()->has('is_active') ? 1 : 0;

        if (request()->hasFile('image')) {
            $data['image'] = request()->file('image')->store('products', 'public');
        }

        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', '✅ Product updated successfully!');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', '🗑️ Product deleted.');
    }

    public function show(Product $product)
    {
        return redirect()->route('admin.products.index');
    }
}
