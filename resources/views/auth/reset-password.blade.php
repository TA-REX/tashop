<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password – TAShop</title>
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
                        <p class="text-muted mt-1">Set a new password</p>
                    </div>
                    <form method="POST" action="{{ route('password.store') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $request->email) }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-semibold">New Password</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-semibold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-danger w-100 py-2 fw-bold">Reset Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
