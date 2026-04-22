<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password – TAShop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #1d3557 0%, #457b9d 100%); min-height: 100vh; display: flex; align-items: center; }
        .auth-card { border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); }
        .brand { font-weight: 900; font-size: 1.8rem; color: #e63946; }
        .btn-danger { background: #e63946; border-color: #e63946; }
        .form-control:focus { border-color: #e63946; box-shadow: 0 0 0 0.2rem rgba(230,57,70,.15); }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card auth-card border-0">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <div class="brand">🛒 TAShop</div>
                        <p class="text-muted mt-1">Reset your password</p>
                    </div>
                    @if(session('status'))
                        <div class="alert alert-success">{{ session('status') }}</div>
                    @endif
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold">Send Reset Link</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}" class="small text-muted text-decoration-none">← Back to Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
