@extends('layouts.app')
@section('title', 'Shopping Cart')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4" style="color:#1d3557">
        <i class="fas fa-shopping-cart text-danger me-2"></i>Shopping Cart
    </h2>

    @if(empty($cart))
    <div class="text-center py-5">
        <div style="font-size:6rem">🛒</div>
        <h4 class="mt-3 text-muted">Your cart is empty</h4>
        <p class="text-muted">Add some products to your cart and they'll appear here.</p>
        <a href="{{ route('shop') }}" class="btn btn-danger btn-lg px-5 mt-2">
            <i class="fas fa-store me-2"></i>Start Shopping
        </a>
    </div>
    @else

    <div class="row g-4">
        {{-- Cart Items --}}
        <div class="col-lg-8">
            @php $emojis = ['📱','⌚','🎧','💻','👕','👖','📚','☕','💡','🧘','💧','🧴']; $i = 0; @endphp
            @foreach($cart as $id => $item)
            <div class="card border-0 shadow-sm mb-3" style="border-radius:12px">
                <div class="card-body p-3">
                    <div class="row align-items-center g-3">
                        {{-- Image --}}
                        <div class="col-auto">
                            <div class="bg-light rounded d-flex align-items-center justify-content-center" style="width:72px;height:72px">
                                @if($item['image'])
                                    <img src="{{ asset('storage/' . $item['image']) }}" style="max-width:64px;max-height:64px;object-fit:contain">
                                @else
                                    <span style="font-size:2.2rem">{{ $emojis[$i++ % count($emojis)] }}</span>
                                @endif
                            </div>
                        </div>
                        {{-- Info --}}
                        <div class="col">
                            <h6 class="fw-bold mb-1">{{ $item['name'] }}</h6>
                            <span class="text-muted small">৳{{ number_format($item['price'], 0) }} each</span>
                        </div>
                        {{-- Quantity --}}
                        <div class="col-auto">
                            <form action="{{ route('cart.update', $id) }}" method="POST" class="d-flex align-items-center gap-2">
                                @csrf
                                <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" max="99"
                                       class="form-control text-center" style="width:65px"
                                       onchange="this.form.submit()">
                            </form>
                        </div>
                        {{-- Subtotal --}}
                        <div class="col-auto text-end">
                            <div class="fw-bold text-danger">৳{{ number_format($item['price'] * $item['quantity'], 0) }}</div>
                        </div>
                        {{-- Remove --}}
                        <div class="col-auto">
                            <form action="{{ route('cart.remove', $id) }}" method="POST">
                                @csrf
                                <button class="btn btn-sm btn-outline-danger rounded-circle" style="width:32px;height:32px;padding:0" title="Remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            <a href="{{ route('shop') }}" class="btn btn-outline-secondary mt-2">
                <i class="fas fa-arrow-left me-1"></i>Continue Shopping
            </a>
        </div>

        {{-- Order Summary --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm" style="border-radius:12px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color:#1d3557">Order Summary</h5>

                    @foreach($cart as $item)
                    <div class="d-flex justify-content-between mb-2 small">
                        <span class="text-muted">{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                        <span>৳{{ number_format($item['price'] * $item['quantity'], 0) }}</span>
                    </div>
                    @endforeach

                    <hr>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>৳{{ number_format($total, 0) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2 text-muted small">
                        <span>Delivery</span>
                        <span class="text-success">FREE</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fw-bold fs-5 mb-4">
                        <span>Total</span>
                        <span class="text-danger">৳{{ number_format($total, 0) }}</span>
                    </div>

                    <a href="{{ route('checkout') }}" class="btn btn-danger w-100 btn-lg fw-bold">
                        Proceed to Checkout <i class="fas fa-arrow-right ms-2"></i>
                    </a>

                    <div class="text-center mt-3">
                        <small class="text-muted"><i class="fas fa-lock me-1"></i>Secure checkout</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
