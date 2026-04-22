<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TAShop – @yield('title', 'Best Online Shop in Bangladesh')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        :root { --ta-red: #e63946; --ta-dark: #1d3557; }
        body { background: #f8f9fa; font-family: 'Segoe UI', sans-serif; }

        /* Navbar */
        .navbar { border-bottom: 3px solid var(--ta-red); background: #fff !important; }
        .navbar-brand { font-weight: 900; font-size: 1.6rem; color: var(--ta-red) !important; letter-spacing: -1px; }
        .nav-link { font-weight: 500; }
        .nav-link:hover { color: var(--ta-red) !important; }
        .cart-badge { position: relative; }
        .cart-badge .badge { position: absolute; top: -8px; right: -8px; font-size: 0.65rem; }

        /* Buttons */
        .btn-primary, .btn-danger { background: var(--ta-red); border-color: var(--ta-red); }
        .btn-primary:hover, .btn-danger:hover { background: #c1121f; border-color: #c1121f; }
        .btn-outline-danger { color: var(--ta-red); border-color: var(--ta-red); }
        .btn-outline-danger:hover { background: var(--ta-red); border-color: var(--ta-red); }

        /* Cards */
        .product-card { border: none; border-radius: 12px; overflow: hidden; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
        .product-card:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(0,0,0,0.13); }
        .product-img-wrap { background: #f1f3f5; height: 180px; display: flex; align-items: center; justify-content: center; overflow: hidden; }
        .product-img-wrap img { max-height: 160px; object-fit: contain; }
        .product-emoji { font-size: 5rem; }
        .price-tag { color: var(--ta-red); font-weight: 700; font-size: 1.1rem; }
        .price-old { text-decoration: line-through; color: #adb5bd; font-size: 0.85rem; }
        .sale-badge { background: var(--ta-red); color: white; font-size: 0.7rem; padding: 2px 8px; border-radius: 20px; }

        /* Hero */
        .hero-section { background: linear-gradient(135deg, var(--ta-dark) 0%, #457b9d 100%); }

        /* Footer */
        footer { background: var(--ta-dark); color: #a8dadc; }
        footer a { color: #a8dadc; text-decoration: none; }
        footer a:hover { color: #fff; }

        /* Section heading */
        .section-heading { font-weight: 800; color: var(--ta-dark); position: relative; padding-bottom: 10px; }
        .section-heading::after { content: ''; position: absolute; bottom: 0; left: 0; width: 48px; height: 4px; background: var(--ta-red); border-radius: 2px; }

        /* Category cards */
        .cat-card { border: 2px solid #e9ecef; border-radius: 12px; transition: all 0.2s; cursor: pointer; text-decoration: none; }
        .cat-card:hover { border-color: var(--ta-red); background: #fff5f5; transform: translateY(-2px); }

        /* Alert flash */
        .flash-alert { border-radius: 0; border: none; }
    </style>
    @stack('styles')
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg sticky-top shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}">🛒 TAShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'text-danger fw-bold' : '' }}" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('shop*') ? 'text-danger fw-bold' : '' }}" href="{{ route('shop') }}">Shop</a>
                </li>
            </ul>

            {{-- Search --}}
            <form class="d-flex me-3" action="{{ route('shop') }}" method="GET">
                <div class="input-group" style="width:280px">
                    <input class="form-control border-end-0" name="search" placeholder="Search products..." value="{{ request('search') }}">
                    <button class="btn btn-outline-danger border-start-0" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <ul class="navbar-nav align-items-center">
                {{-- Cart icon --}}
                <li class="nav-item me-2">
                    <a class="nav-link cart-badge" href="{{ route('cart.index') }}">
                        <i class="fas fa-shopping-cart fs-5"></i>
                        @if(session('cart') && count(session('cart')) > 0)
                            <span class="badge bg-danger rounded-pill">{{ count(session('cart')) }}</span>
                        @endif
                    </a>
                </li>

                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-1" href="#" data-bs-toggle="dropdown">
                            <div class="rounded-circle bg-danger text-white d-flex align-items-center justify-content-center" style="width:32px;height:32px;font-size:0.8rem">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span>{{ auth()->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow">
                            <li><a class="dropdown-item" href="{{ route('orders.index') }}"><i class="fas fa-box me-2"></i>My Orders</a></li>
                            @if(auth()->user()->role === 'admin')
                                <li><a class="dropdown-item text-danger" href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt me-2"></i>Admin Panel</a></li>
                            @endif
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-sign-out-alt me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger text-white ms-2 px-3" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- Flash Messages --}}
@if(session('success'))
    <div class="alert alert-success flash-alert alert-dismissible fade show mb-0 rounded-0" role="alert">
        <div class="container">{{ session('success') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif
@if(session('error'))
    <div class="alert alert-danger flash-alert alert-dismissible fade show mb-0 rounded-0" role="alert">
        <div class="container">{{ session('error') }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

@yield('content')

{{-- Footer --}}
<footer class="py-5 mt-5">
    <div class="container">
        <div class="row gy-4">
            <div class="col-md-4">
                <h5 class="text-white fw-bold mb-3">🛒 TAShop</h5>
                <p class="small">Your trusted online shopping destination in Bangladesh. Quality products, fast delivery, best prices.</p>
            </div>
            <div class="col-md-2">
                <h6 class="text-white fw-bold mb-3">Shop</h6>
                <ul class="list-unstyled small">
                    <li><a href="{{ route('shop') }}">All Products</a></li>
                    <li><a href="{{ route('shop', ['sort' => 'price_asc']) }}">Best Price</a></li>
                </ul>
            </div>
            <div class="col-md-2">
                <h6 class="text-white fw-bold mb-3">Account</h6>
                <ul class="list-unstyled small">
                    @auth
                        <li><a href="{{ route('orders.index') }}">My Orders</a></li>
                    @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        <li><a href="{{ route('register') }}">Register</a></li>
                    @endauth
                </ul>
            </div>
            <div class="col-md-4">
                <h6 class="text-white fw-bold mb-3">Contact</h6>
                <p class="small mb-1"><i class="fas fa-envelope me-2"></i>support@tashop.com</p>
                <p class="small mb-1"><i class="fas fa-phone me-2"></i>+880 1700-000000</p>
                <p class="small"><i class="fas fa-map-marker-alt me-2"></i>Dhaka, Bangladesh</p>
            </div>
        </div>
        <hr class="border-secondary mt-4">
        <p class="text-center small mb-0">© {{ date('Y') }} TAShop. All rights reserved. Made with ❤️ in Bangladesh.</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
