@extends('layouts.app')
@section('title', 'Checkout')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4" style="color:#1d3557">
        <i class="fas fa-credit-card text-danger me-2"></i>Checkout
    </h2>

    <div class="row g-4">
        {{-- Shipping Form --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm" style="border-radius:12px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color:#1d3557">
                        <i class="fas fa-map-marker-alt text-danger me-2"></i>Shipping Information
                    </h5>
                    <form action="{{ route('checkout.place') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name <span class="text-danger">*</span></label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', auth()->user()->name) }}" required placeholder="Your full name">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone') }}" required placeholder="01XXXXXXXXX">
                            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Delivery Address <span class="text-danger">*</span></label>
                            <textarea name="address" class="form-control @error('address') is-invalid @enderror"
                                      rows="3" required placeholder="House/Flat, Road, Area, City">{{ old('address') }}</textarea>
                            @error('address')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Payment Method</label>
                            <div class="border rounded p-3 bg-light">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="payment_method" value="cod" id="cod" checked>
                                    <label class="form-check-label fw-semibold" for="cod">
                                        <i class="fas fa-money-bill-wave text-success me-2"></i>Cash on Delivery (COD)
                                    </label>
                                    <p class="text-muted small mb-0 mt-1">Pay when your order arrives at your doorstep.</p>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-danger btn-lg w-100 fw-bold">
                            <i class="fas fa-check-circle me-2"></i>Place Order – ৳{{ number_format($total, 0) }}
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Order Summary --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm" style="border-radius:12px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color:#1d3557">
                        <i class="fas fa-receipt text-danger me-2"></i>Your Order
                    </h5>

                    @foreach($cart as $item)
                    <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                        <div class="bg-light rounded d-flex align-items-center justify-content-center flex-shrink-0" style="width:50px;height:50px">
                            <span>🛍️</span>
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-semibold small">{{ $item['name'] }}</div>
                            <div class="text-muted small">Qty: {{ $item['quantity'] }}</div>
                        </div>
                        <div class="fw-bold small">৳{{ number_format($item['price'] * $item['quantity'], 0) }}</div>
                    </div>
                    @endforeach

                    <div class="d-flex justify-content-between mb-1">
                        <span class="text-muted">Subtotal</span>
                        <span>৳{{ number_format($total, 0) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span class="text-muted">Delivery</span>
                        <span class="text-success fw-semibold">FREE</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between fw-bold fs-5">
                        <span>Total</span>
                        <span class="text-danger">৳{{ number_format($total, 0) }}</span>
                    </div>

                    <div class="mt-3 p-3 bg-light rounded small text-muted">
                        <i class="fas fa-info-circle text-danger me-1"></i>
                        By placing your order you agree to TAShop's terms and conditions.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
