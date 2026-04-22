@extends('layouts.admin')
@section('title', 'Order #' . $order->id)

@section('content')
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-sm">
        <i class="fas fa-arrow-left"></i>
    </a>
    <h4 class="fw-bold mb-0">Order #{{ $order->id }}</h4>
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
    <span class="badge bg-{{ $badge }} px-3 py-2 fs-6">{{ ucfirst($order->status) }}</span>
</div>

<div class="row g-4">
    {{-- Order Items --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white border-0 pt-3">
                <h6 class="fw-bold mb-0"><i class="fas fa-shopping-bag text-danger me-2"></i>Order Items</h6>
            </div>
            <div class="card-body p-0">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">Product</th>
                            <th>Unit Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                        <tr>
                            <td class="ps-3">
                                <div class="d-flex align-items-center gap-2">
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center flex-shrink-0" style="width:46px;height:46px">
                                        @if($item->product && $item->product->image)
                                            <img src="{{ asset('storage/'.$item->product->image) }}" style="max-width:40px;max-height:40px;object-fit:contain">
                                        @else
                                            <span>🛍️</span>
                                        @endif
                                    </div>
                                    <div class="fw-semibold small">{{ $item->product->name ?? 'Deleted product' }}</div>
                                </div>
                            </td>
                            <td class="small">৳{{ number_format($item->price, 0) }}</td>
                            <td><span class="badge bg-light text-dark border">× {{ $item->quantity }}</span></td>
                            <td class="fw-bold text-danger">৳{{ number_format($item->price * $item->quantity, 0) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="3" class="text-end fw-bold pe-3">Order Total:</td>
                            <td class="fw-bold text-danger fs-5">৳{{ number_format($order->total, 0) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    {{-- Right Column --}}
    <div class="col-lg-4">
        {{-- Customer Info --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-user text-danger me-2"></i>Customer</h6>
                <p class="mb-1 fw-semibold">{{ $order->user->name }}</p>
                <p class="mb-1 text-muted small"><i class="fas fa-envelope me-1"></i>{{ $order->user->email }}</p>
                <p class="mb-0 text-muted small"><i class="fas fa-phone me-1"></i>{{ $order->phone }}</p>
            </div>
        </div>

        {{-- Shipping Address --}}
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-map-marker-alt text-danger me-2"></i>Delivery Address</h6>
                <p class="mb-0 text-muted small">{{ $order->address }}</p>
            </div>
        </div>

        {{-- Update Status --}}
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <h6 class="fw-bold mb-3"><i class="fas fa-sync text-danger me-2"></i>Update Status</h6>
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf @method('PUT')
                    <select name="status" class="form-select mb-3">
                        @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                        <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>
                            {{ ucfirst($s) }}
                        </option>
                        @endforeach
                    </select>
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="fas fa-check me-1"></i>Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
