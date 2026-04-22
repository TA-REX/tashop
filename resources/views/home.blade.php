@extends('layouts.app')
@section('title', 'Welcome to TAShop')

@section('content')

{{-- Hero Banner --}}
<section class="hero-section text-white py-5">
    <div class="container py-3">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <span class="badge bg-danger mb-3 px-3 py-2">🔥 Best Deals in Bangladesh</span>
                <h1 class="display-4 fw-bold mb-3" style="line-height:1.2">Shop Smart,<br>Live Better.</h1>
                <p class="lead mb-4 opacity-75">Discover thousands of products at unbeatable prices. Fast delivery across Bangladesh.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('shop') }}" class="btn btn-danger btn-lg px-4 fw-bold">
                        Shop Now <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">
                        Join Free
                    </a>
                </div>
            </div>
            <div class="col-lg-6 text-center d-none d-lg-block">
                <div style="font-size:10rem; filter:drop-shadow(0 20px 40px rgba(0,0,0,0.3))">🛍️</div>
            </div>
        </div>
    </div>
</section>

{{-- Trust Badges --}}
<section class="bg-white border-bottom py-3">
    <div class="container">
        <div class="row text-center gy-2">
            <div class="col-6 col-md-3">
                <span class="text-danger fw-bold"><i class="fas fa-shipping-fast me-1"></i></span>
                <span class="small fw-semibold">Fast Delivery</span>
            </div>
            <div class="col-6 col-md-3">
                <span class="text-danger fw-bold"><i class="fas fa-lock me-1"></i></span>
                <span class="small fw-semibold">Secure Payment</span>
            </div>
            <div class="col-6 col-md-3">
                <span class="text-danger fw-bold"><i class="fas fa-undo me-1"></i></span>
                <span class="small fw-semibold">Easy Returns</span>
            </div>
            <div class="col-6 col-md-3">
                <span class="text-danger fw-bold"><i class="fas fa-headset me-1"></i></span>
                <span class="small fw-semibold">24/7 Support</span>
            </div>
        </div>
    </div>
</section>

{{-- Categories --}}
<section class="container my-5">
    <h2 class="section-heading mb-4">Shop by Category</h2>
    <div class="row g-3">
        @php
        $emojis = ['📱','👕','📚','🏠','⚽','💄','🎮','🍳'];
        @endphp
        @foreach($categories as $i => $cat)
        <div class="col-6 col-md-4 col-lg-2">
            <a href="{{ route('shop', ['category' => $cat->id]) }}" class="cat-card d-block text-center py-3 px-2 text-decoration-none">
                <div style="font-size:2.2rem">{{ $emojis[$i] ?? '📦' }}</div>
                <div class="fw-semibold small mt-1" style="color:#1d3557">{{ $cat->name }}</div>
                <div class="text-muted" style="font-size:0.72rem">{{ $cat->products_count }} items</div>
            </a>
        </div>
        @endforeach
    </div>
</section>

{{-- Featured Products --}}
<section class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-heading mb-0">Featured Products</h2>
        <a href="{{ route('shop') }}" class="btn btn-outline-danger btn-sm">View All <i class="fas fa-arrow-right ms-1"></i></a>
    </div>
    <div class="row g-4">
        @foreach($featured as $product)
        <div class="col-6 col-md-4 col-lg-3">
            <div class="card product-card h-100">
                <div class="product-img-wrap">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                    @else
                        @php
                        $productEmojis = ['📱','⌚','🎧','💻','👕','👖','📚','☕','💡','🧘','💧','🧴'];
                        @endphp
                        <span class="product-emoji">{{ $productEmojis[$product->id % count($productEmojis)] }}</span>
                    @endif
                    @if($product->sale_price)
                        <span class="sale-badge position-absolute top-0 end-0 m-2">SALE</span>
                    @endif
                </div>
                <div class="card-body d-flex flex-column p-3">
                    <p class="text-muted small mb-1">{{ $product->category->name }}</p>
                    <h6 class="card-title fw-semibold mb-2" style="font-size:0.9rem">{{ $product->name }}</h6>
                    <div class="mt-auto">
                        <div class="mb-2">
                            <span class="price-tag">৳{{ number_format($product->sale_price ?? $product->price, 0) }}</span>
                            @if($product->sale_price)
                                <span class="price-old ms-1">৳{{ number_format($product->price, 0) }}</span>
                            @endif
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('product.show', $product->slug) }}" class="btn btn-outline-danger btn-sm flex-grow-1">View</a>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button class="btn btn-danger btn-sm px-2" title="Add to cart">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

{{-- Banner CTA --}}
<section class="container my-5">
    <div class="rounded-3 p-5 text-white text-center" style="background: linear-gradient(135deg,#e63946,#1d3557)">
        <h3 class="fw-bold mb-2">New Customer? Get 10% Off!</h3>
        <p class="mb-4 opacity-75">Register now and use code <strong>WELCOME10</strong> on your first order.</p>
        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 fw-bold text-danger">Create Free Account</a>
    </div>
</section>

@endsection
