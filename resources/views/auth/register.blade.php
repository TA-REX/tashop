<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register – TAShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1d3557 0%, #457b9d 100%); min-height: 100vh; display: flex; align-items: center; padding: 2rem 0; }
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
        <div class="col-md-6 col-lg-5">
            <div class="card auth-card border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="brand">🛒 TAShop</div>
                        <p class="text-muted mt-1">Create your free account</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" required autofocus placeholder="John Doe">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required placeholder="you@example.com">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                   required placeholder="Min 8 characters">
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control"
                                   required placeholder="Repeat password">
                        </div>

                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold">
                            <i class="fas fa-user-plus me-2"></i>Create Account
                        </button>
                    </form>

                    <hr class="my-4">
                    <div class="text-center small text-muted">
                        Already have an account?
                        <a href="{{ route('login') }}" class="text-danger fw-bold text-decoration-none">Sign In</a>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="{{ route('home') }}" class="small text-muted text-decoration-none">
                            <i class="fas fa-arrow-left me-1"></i>Back to Shop
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
