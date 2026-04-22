@extends('layouts.admin')
@section('title', 'Orders')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">All Orders</h4>
    <span class="badge bg-danger px-3 py-2">{{ $orders->total() }} Total</span>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
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
                    <tr>
                        <td class="ps-3 fw-bold">#{{ $order->id }}</td>
                        <td>
                            <div class="fw-semibold small">{{ $order->user->name }}</div>
                            <div class="text-muted" style="font-size:0.75rem">{{ $order->user->email }}</div>
                        </td>
                        <td class="small text-muted">{{ $order->phone }}</td>
                        <td class="fw-bold text-danger">৳{{ number_format($order->total, 0) }}</td>
                        <td><span class="badge bg-light text-dark border">{{ strtoupper($order->payment_method) }}</span></td>
                        <td>
                            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                                @csrf @method('PUT')
                                <select name="status" class="form-select form-select-sm" style="width:130px" onchange="this.form.submit()">
                                    @foreach(['pending','processing','shipped','delivered','cancelled'] as $s)
                                    <option value="{{ $s }}" {{ $order->status === $s ? 'selected' : '' }}>
                                        {{ ucfirst($s) }}
                                    </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td class="small text-muted">{{ $order->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">No orders yet.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($orders->hasPages())
    <div class="card-footer bg-white border-0 pb-3 px-3">
        {{ $orders->links() }}
    </div>
    @endif
</div>
@endsection
