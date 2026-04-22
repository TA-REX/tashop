<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TAShop Admin – @yield('title', 'Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: #f0f2f5; }
        .sidebar { width: 240px; min-height: 100vh; background: #1d3557; position: fixed; top: 0; left: 0; z-index: 100; overflow-y: auto; }
        .sidebar-brand { padding: 1.2rem 1.5rem; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .sidebar-brand span { font-size: 1.3rem; font-weight: 900; color: #e63946; }
        .sidebar .nav-link { color: #a8dadc; padding: 0.65rem 1.5rem; border-radius: 0; font-size: 0.9rem; transition: all 0.2s; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: rgba(230,57,70,0.15); color: #fff; border-left: 3px solid #e63946; }
        .sidebar .nav-link i { width: 20px; }
        .sidebar-section { padding: 0.5rem 1.5rem; font-size: 0.7rem; text-transform: uppercase; color: rgba(255,255,255,0.35); letter-spacing: 1px; margin-top: 1rem; }
        .main-content { margin-left: 240px; padding: 0; }
        .top-bar { background: #fff; border-bottom: 1px solid #dee2e6; padding: 0.75rem 1.5rem; position: sticky; top: 0; z-index: 50; }
        .content-area { padding: 1.5rem; }
        .stat-card { border: none; border-radius: 12px; overflow: hidden; }
        .stat-card .icon-box { width: 56px; height: 56px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; }
    </style>
</head>
<body>

{{-- Sidebar --}}
<div class="sidebar">
    <div class="sidebar-brand">
        <span>🛒 TAShop</span>
        <div style="font-size:0.7rem; color:rgba(255,255,255,0.4); margin-top:2px">Admin Panel</div>
    </div>

    <nav class="nav flex-column mt-2">
        <div class="sidebar-section">Main</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt me-2"></i> Dashboard
        </a>

        <div class="sidebar-section">Catalog</div>
        <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products*') ? 'active' : '' }}">
            <i class="fas fa-box me-2"></i> Products
        </a>

        <div class="sidebar-section">Sales</div>
        <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
            <i class="fas fa-shopping-bag me-2"></i> Orders
        </a>

        <div class="sidebar-section">Site</div>
        <a href="{{ route('home') }}" class="nav-link" target="_blank">
            <i class="fas fa-external-link-alt me-2"></i> View Shop
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link border-0 bg-transparent w-100 text-start">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
            </button>
        </form>
    </nav>
</div>

{{-- Main Content --}}
<div class="main-content">
    <div class="top-bar d-flex align-items-center justify-content-between">
        <h6 class="mb-0 fw-bold">@yield('title', 'Dashboard')</h6>
        <div class="d-flex align-items-center gap-2">
            <span class="text-muted small">Logged in as</span>
            <span class="fw-bold small">{{ auth()->user()->name }}</span>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-0 mb-0">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show rounded-0 mb-0">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="content-area">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
