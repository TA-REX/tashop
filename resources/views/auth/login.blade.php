<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login – TAShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1d3557 0%, #457b9d 100%); min-height: 100vh; display: flex; align-items: center; }
        .auth-card { border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .brand { font-weight: 900; font-size: 1.8rem; color: #e63946; }
        .btn-danger { background: #e63946; border-color: #e63946; }
        .btn-danger:hover { background: #c1121f; border-color: #c1121f; }
        .form-control:focus { border-color: #e63946; box-shadow: 0 0 0 0.2rem rgba(230,57,70,.15); }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5 col-lg-4">
            <div class="card auth-card border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="brand">🛒 TAShop</div>
                        <p class="text-muted mt-1">Sign in to your account</p>
                    </div>

                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required autofocus placeholder="you@example.com">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                   required placeholder="••••••••">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label small" for="remember">Remember me</label>
                            </div>
                            @if(Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="small text-danger text-decoration-none">Forgot password?</a>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>
                    </form>

                    <hr class="my-4">
                    <div class="text-center small text-muted">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="text-danger fw-bold text-decoration-none">Register Free</a>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route('home') }}" class="small text-muted text-decoration-none">
                            <i class="fas fa-arrow-left me-1"></i>Back to Shop
                        </a>
                    </div>
                </div>
            </div>

            {{-- Demo credentials --}}
            <div class="card border-0 mt-3" style="background:rgba(255,255,255,0.1); border-radius:12px">
                <div class="card-body p-3 text-white small">
                    <div class="fw-bold mb-2 opacity-75">Demo Credentials:</div>
                    <div>👤 Admin: <code>admin@tashop.com</code> / <code>password</code></div>
                    <div>🛒 User: <code>customer@tashop.com</code> / <code>password</code></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
