@extends('layouts.app')
@section('title', $product->name)

@section('content')
<div class="container my-5">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-danger">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop') }}" class="text-danger">Shop</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop', ['category' => $product->category_id]) }}" class="text-danger">{{ $product->category->name }}</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-5">
        {{-- Product Image --}}
        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4 text-center" style="border-radius:16px">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="img-fluid" style="max-height:350px; object-fit:contain">
                @else
                    @php
                    $emojis = ['📱','⌚','🎧','💻','👕','👖','📚','☕','💡','🧘','💧','🧴'];
                    @endphp
                    <div style="font-size:9rem; padding:2rem 0">{{ $emojis[$product->id % count($emojis)] }}</div>
                @endif
            </div>
        </div>

        {{-- Product Info --}}
        <div class="col-md-7">
            <span class="badge bg-light text-danger border border-danger mb-2">{{ $product->category->name }}</span>
            <h1 class="fw-bold mb-3" style="color:#1d3557">{{ $product->name }}</h1>

            {{-- Price --}}
            <div class="mb-3">
                <span style="font-size:2rem; font-weight:800; color:#e63946">
                    ৳{{ number_format($product->sale_price ?? $product->price, 0) }}
                </span>
                @if($product->sale_price)
                    <span class="text-muted text-decoration-line-through ms-2 fs-5">৳{{ number_format($product->price, 0) }}</span>
                    <span class="badge bg-danger ms-2">
                        {{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% OFF
                    </span>
                @endif
            </div>

            {{-- Stock Status --}}
            <div class="mb-4">
                @if($product->stock > 10)
                    <span class="badge bg-success fs-6 px-3 py-2"><i class="fas fa-check-circle me-1"></i>In Stock</span>
                @elseif($product->stock > 0)
                    <span class="badge bg-warning text-dark fs-6 px-3 py-2"><i class="fas fa-exclamation-triangle me-1"></i>Only {{ $product->stock }} left!</span>
                @else
                    <span class="badge bg-danger fs-6 px-3 py-2"><i class="fas fa-times-circle me-1"></i>Out of Stock</span>
                @endif
            </div>

            {{-- Description --}}
            @if($product->description)
            <div class="mb-4">
                <h6 class="fw-bold text-muted text-uppercase small">Description</h6>
                <p class="text-muted">{{ $product->description }}</p>
            </div>
            @endif

            {{-- Add to Cart --}}
            @if($product->stock > 0)
            <form action="{{ route('cart.add') }}" method="POST" class="mb-3">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn btn-danger btn-lg px-5">
                    <i class="fas fa-cart-plus me-2"></i>Add to Cart
                </button>
            </form>
            @else
            <button class="btn btn-secondary btn-lg px-5" disabled>
                <i class="fas fa-times me-2"></i>Out of Stock
            </button>
            @endif

            <a href="{{ route('shop') }}" class="btn btn-outline-secondary ms-2">
                <i class="fas fa-arrow-left me-1"></i>Continue Shopping
            </a>

            {{-- Features --}}
            <div class="row g-2 mt-4">
                <div class="col-4 text-center p-2 bg-light rounded">
                    <div class="text-danger"><i class="fas fa-truck"></i></div>
                    <div style="font-size:0.72rem" class="text-muted mt-1">Fast Delivery</div>
                </div>
                <div class="col-4 text-center p-2 bg-light rounded">
                    <div class="text-danger"><i class="fas fa-shield-alt"></i></div>
                    <div style="font-size:0.72rem" class="text-muted mt-1">Genuine Product</div>
                </div>
                <div class="col-4 text-center p-2 bg-light rounded">
                    <div class="text-danger"><i class="fas fa-undo"></i></div>
                    <div style="font-size:0.72rem" class="text-muted mt-1">Easy Return</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Related Products --}}
    @if($related->count() > 0)
    <div class="mt-5">
        <h4 class="section-heading mb-4">Related Products</h4>
        <div class="row g-3">
            @foreach($related as $rel)
            <div class="col-6 col-md-3">
                <div class="card product-card h-100">
                    <div class="product-img-wrap">
                        @if($rel->image)
                            <img src="{{ asset('storage/' . $rel->image) }}" alt="{{ $rel->name }}">
                        @else
                            <span class="product-emoji" style="font-size:3rem">📦</span>
                        @endif
                    </div>
                    <div class="card-body p-3">
                        <h6 class="fw-semibold mb-1" style="font-size:0.85rem">{{ $rel->name }}</h6>
                        <div class="price-tag mb-2">৳{{ number_format($rel->sale_price ?? $rel->price, 0) }}</div>
                        <a href="{{ route('product.show', $rel->slug) }}" class="btn btn-outline-danger btn-sm w-100">View</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
@endsection
