@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')

{{-- Stat Cards --}}
<div class="row g-4 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm border-0">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="icon-box bg-danger bg-opacity-10">
                    <span>💰</span>
                </div>
                <div>
                    <div class="text-muted small">Total Revenue</div>
                    <div class="fw-bold fs-5">৳{{ number_format($revenue, 0) }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm border-0">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="icon-box bg-primary bg-opacity-10">
                    <span>📦</span>
                </div>
                <div>
                    <div class="text-muted small">Total Orders</div>
                    <div class="fw-bold fs-5">{{ $totalOrders }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm border-0">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="icon-box bg-success bg-opacity-10">
                    <span>🛍️</span>
                </div>
                <div>
                    <div class="text-muted small">Products</div>
                    <div class="fw-bold fs-5">{{ $totalProducts }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card shadow-sm border-0">
            <div class="card-body p-4 d-flex align-items-center gap-3">
                <div class="icon-box bg-warning bg-opacity-10">
                    <span>👥</span>
                </div>
                <div>
                    <div class="text-muted small">Customers</div>
                    <div class="fw-bold fs-5">{{ $totalUsers }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($lowStock > 0)
<div class="alert alert-warning border-0 shadow-sm mb-4">
    <i class="fas fa-exclamation-triangle me-2"></i>
    <strong>{{ $lowStock }}</strong> product(s) are running low on stock!
    <a href="{{ route('admin.products.index') }}" class="alert-link ms-2">View Products →</a>
</div>
@endif

<div class="row g-4">
    {{-- Recent Orders --}}
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center pt-3">
                <h6 class="fw-bold mb-0">Recent Orders</h6>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-danger btn-sm">View All</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-3">#</th>
                                <th>Customer</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentOrders as $order)
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
                                <td class="ps-3 fw-semibold">#{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td class="text-danger fw-bold">৳{{ number_format($order->total, 0) }}</td>
                                <td><span class="badge bg-{{ $badge }}">{{ ucfirst($order->status) }}</span></td>
                                <td class="text-muted small">{{ $order->created_at->format('d M Y') }}</td>
                                <td><a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-secondary">View</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Categories Breakdown --}}
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white border-0 pt-3">
                <h6 class="fw-bold mb-0">Products by Category</h6>
            </div>
            <div class="card-body">
                @foreach($categories as $cat)
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span class="small fw-semibold">{{ $cat->name }}</span>
                        <span class="small text-muted">{{ $cat->products_count }}</span>
                    </div>
                    <div class="progress" style="height:6px">
                        <div class="progress-bar bg-danger" style="width:{{ $totalProducts > 0 ? ($cat->products_count / $totalProducts * 100) : 0 }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
