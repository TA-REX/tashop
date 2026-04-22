@extends('layouts.app')
@section('title', 'My Orders')

@section('content')
<div class="container my-5">
    <h2 class="fw-bold mb-4" style="color:#1d3557">
        <i class="fas fa-box text-danger me-2"></i>My Orders
    </h2>

    @forelse($orders as $order)
    <div class="card border-0 shadow-sm mb-3" style="border-radius:12px">
        <div class="card-body p-4">
            <div class="row align-items-center g-3">
                <div class="col-md-2">
                    <div class="text-muted small">Order</div>
                    <div class="fw-bold">#{{ $order->id }}</div>
                </div>
                <div class="col-md-3">
                    <div class="text-muted small">Date</div>
                    <div class="fw-semibold">{{ $order->created_at->format('d M Y') }}</div>
                </div>
                <div class="col-md-2">
                    <div class="text-muted small">Items</div>
                    <div class="fw-semibold">{{ $order->items->count() }} item(s)</div>
                </div>
                <div class="col-md-2">
                    <div class="text-muted small">Total</div>
                    <div class="fw-bold text-danger">৳{{ number_format($order->total, 0) }}</div>
                </div>
                <div class="col-md-2">
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
                    <span class="badge bg-{{ $badge }} px-3 py-2">{{ ucfirst($order->status) }}</span>
                </div>
                <div class="col-md-1 text-end">
                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-outline-danger btn-sm">
                        <i class="fas fa-eye"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @empty
    <div class="text-center py-5">
        <div style="font-size:5rem">📦</div>
        <h5 class="mt-3 text-muted">No orders yet</h5>
        <p class="text-muted">You haven't placed any orders. Start shopping now!</p>
        <a href="{{ route('shop') }}" class="btn btn-danger mt-2">Shop Now</a>
    </div>
    @endforelse
</div>
@endsection
