@extends('layouts.app')
@section('title', 'Shop')

@section('content')
<div class="container my-4">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-danger">Home</a></li>
            <li class="breadcrumb-item active">Shop</li>
        </ol>
    </nav>

    <div class="row g-4">

        {{-- Sidebar --}}
        <div class="col-lg-3">
            <div class="card border-0 shadow-sm p-3 mb-3">
                <h6 class="fw-bold mb-3" style="color:#1d3557">
                    <i class="fas fa-list me-2 text-danger"></i>Categories
                </h6>
                <a href="{{ route('shop') }}" class="d-flex justify-content-between align-items-center py-2 px-2 rounded text-decoration-none mb-1 {{ !request('category') ? 'bg-danger text-white' : 'text-dark hover-red' }}">
                    <span>All Products</span>
                    <span class="badge {{ !request('category') ? 'bg-white text-danger' : 'bg-light text-muted' }}">{{ $products->total() }}</span>
                </a>
                @foreach($categories as $cat)
                <a href="{{ route('shop', ['category' => $cat->id, 'search' => request('search')]) }}"
                   class="d-flex justify-content-between align-items-center py-2 px-2 rounded text-decoration-none mb-1 {{ request('category') == $cat->id ? 'bg-danger text-white' : 'text-dark' }}">
                    <span>{{ $cat->name }}</span>
                    <span class="badge {{ request('category') == $cat->id ? 'bg-white text-danger' : 'bg-light text-muted' }}">{{ $cat->products()->count() }}</span>
                </a>
                @endforeach
            </div>

            <div class="card border-0 shadow-sm p-3">
                <h6 class="fw-bold mb-3" style="color:#1d3557"><i class="fas fa-sort me-2 text-danger"></i>Sort By</h6>
                <a href="{{ route('shop', array_merge(request()->except('sort'), [])) }}" class="d-block py-1 text-decoration-none {{ !request('sort') ? 'text-danger fw-bold' : 'text-muted' }}">Newest First</a>
                <a href="{{ route('shop', array_merge(request()->query(), ['sort' => 'price_asc'])) }}" class="d-block py-1 text-decoration-none {{ request('sort') === 'price_asc' ? 'text-danger fw-bold' : 'text-muted' }}">Price: Low to High</a>
                <a href="{{ route('shop', array_merge(request()->query(), ['sort' => 'price_desc'])) }}" class="d-block py-1 text-decoration-none {{ request('sort') === 'price_desc' ? 'text-danger fw-bold' : 'text-muted' }}">Price: High to Low</a>
            </div>
        </div>

        {{-- Products Grid --}}
        <div class="col-lg-9">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <span class="text-muted small">Showing <strong>{{ $products->count() }}</strong> of <strong>{{ $products->total() }}</strong> products</span>
                    @if(request('search'))
                        <span class="badge bg-light text-dark ms-2">Search: "{{ request('search') }}" <a href="{{ route('shop') }}" class="text-danger ms-1">✕</a></span>
                    @endif
                </div>
            </div>

            @if($products->count() > 0)
            <div class="row g-3">
                @php
                $emojis = ['📱','⌚','🎧','💻','👕','👖','📚','☕','💡','🧘','💧','🧴','🎮','🍳','⚽','💄'];
                @endphp
                @foreach($products as $product)
                <div class="col-sm-6 col-xl-4">
                    <div class="card product-card h-100">
                        <div class="product-img-wrap position-relative">
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                            @else
                                <span class="product-emoji">{{ $emojis[$product->id % count($emojis)] }}</span>
                            @endif
                            @if($product->sale_price)
                                <span class="badge bg-danger position-absolute top-0 start-0 m-2">SALE</span>
                            @endif
                            @if($product->stock === 0)
                                <span class="badge bg-secondary position-absolute top-0 end-0 m-2">Out of Stock</span>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column p-3">
                            <p class="text-muted mb-1" style="font-size:0.75rem">{{ $product->category->name }}</p>
                            <h6 class="fw-semibold mb-2" style="font-size:0.88rem">{{ $product->name }}</h6>
                            <div class="mt-auto">
                                <div class="mb-2">
                                    <span class="price-tag">৳{{ number_format($product->sale_price ?? $product->price, 0) }}</span>
                                    @if($product->sale_price)
                                        <span class="price-old ms-1">৳{{ number_format($product->price, 0) }}</span>
                                    @endif
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('product.show', $product->slug) }}" class="btn btn-outline-danger btn-sm flex-grow-1">Details</a>
                                    @if($product->stock > 0)
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button class="btn btn-danger btn-sm px-2" title="Add to cart">
                                            <i class="fas fa-cart-plus"></i>
                                        </button>
                                    </form>
                                    @else
                                    <button class="btn btn-secondary btn-sm px-2" disabled title="Out of stock">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-4 d-flex justify-content-center">
                {{ $products->links() }}
            </div>

            @else
            <div class="text-center py-5">
                <div style="font-size:5rem">🔍</div>
                <h5 class="mt-3">No products found</h5>
                <p class="text-muted">Try a different search or browse all categories.</p>
                <a href="{{ route('shop') }}" class="btn btn-danger">Clear Filters</a>
            </div>
            @endif
        </div>

    </div>
</div>
@endsection
