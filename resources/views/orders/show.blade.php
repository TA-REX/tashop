@extends('layouts.app')
@section('title', 'Order #' . $order->id)

@section('content')
<div class="container my-5">

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h2 class="fw-bold mb-0" style="color:#1d3557">Order #{{ $order->id }}</h2>
        <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i>Back to Orders
        </a>
    </div>

    @php
    $badge = match($order->status) {
        'pending'    => 'warning',
        'processing' => 'info',
        'shipped'    => 'primary',
        'delivered'  => 'success',
        'cancelled'  => 'danger',
        default      => 'secondary',
    };
    @endphp

    {{-- Status Banner --}}
    <div class="alert border-0 bg-{{ $badge }} bg-opacity-10 border-start border-{{ $badge }} border-4 mb-4">
        <div class="d-flex align-items-center">
            <span class="badge bg-{{ $badge }} me-3 px-3 py-2 fs-6">{{ ucfirst($order->status) }}</span>
            <span>Order placed on {{ $order->created_at->format('d M Y \a\t h:i A') }}</span>
        </div>
    </div>

    <div class="row g-4">
        {{-- Order Items --}}
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4" style="border-radius:12px">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4" style="color:#1d3557">
                        <i class="fas fa-shopping-bag text-danger me-2"></i>Order Items
                    </h5>
                    @foreach($order->items as $item)
                    <div class="d-flex align-items-center gap-3 mb-3 pb-3 border-bottom">
                        <div class="bg-light rounded d-flex align-items-center justify-content-center flex-shrink-0" style="width:64px;height:64px">
                            @if($item->product && $item->product->image)
                                <img src="{{ asset('storage/'.$item->product->image) }}" style="max-width:56px;max-height:56px;object-fit:contain">
                            @else
                                <span style="font-size:2rem">🛍️</span>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <div class="fw-bold">{{ $item->product->name ?? 'Product unavailable' }}</div>
                            <div class="text-muted small">৳{{ number_format($item->price, 0) }} × {{ $item->quantity }}</div>
                        </div>
                        <div class="fw-bold text-danger">৳{{ number_format($item->price * $item->quantity, 0) }}</div>
                    </div>
                    @endforeach

                    <div class="d-flex justify-content-between mt-2">
                        <span class="text-muted">Delivery</span>
                        <span class="text-success fw-semibold">FREE</span>
                    </div>
                    <div class="d-flex justify-content-between fw-bold fs-5 mt-2">
                        <span>Total</span>
                        <span class="text-danger">৳{{ number_format($order->total, 0) }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Shipping & Payment --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-3" style="border-radius:12px">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color:#1d3557">
                        <i class="fas fa-map-marker-alt text-danger me-2"></i>Delivery Address
                    </h6>
                    <p class="mb-1 fw-semibold">{{ $order->name }}</p>
                    <p class="mb-1 text-muted small"><i class="fas fa-phone me-1"></i>{{ $order->phone }}</p>
                    <p class="mb-0 text-muted small"><i class="fas fa-map-marker-alt me-1"></i>{{ $order->address }}</p>
                </div>
            </div>

            <div class="card border-0 shadow-sm" style="border-radius:12px">
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3" style="color:#1d3557">
                        <i class="fas fa-money-bill text-danger me-2"></i>Payment
                    </h6>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted">Method</span>
                        <span class="fw-semibold">{{ strtoupper($order->payment_method) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
