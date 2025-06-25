<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Puskesmas Wundulako - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #6e8efb, #a777e3);
            min-height: 100vh;
        }
        .card {
            border: none;
            border-radius: 15px;
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        }
        .form-control {
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #6e8efb;
            box-shadow: 0 0 0 0.25rem rgba(110, 142, 251, 0.25);
        }
        .btn-primary {
            border-radius: 10px;
            padding: 12px;
            background: linear-gradient(90deg, #6e8efb, #a777e3);
            border: none;
            transition: transform 0.2s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
        }
        .form-label {
            font-weight: 500;
            color: #333;
        }
        .alert {
            border-radius: 10px;
        }
        .gradient-text {
            background: linear-gradient(90deg, #6e8efb, #a777e3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4" style="width: 400px;">
        <h3 class="text-center mb-4 fw-bold gradient-text">Puskesmas Wundulako - Login</h3>
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $errors->first() }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required autofocus placeholder="Masukkan email">
            </div>
            <div class="mb-4">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required placeholder="Masukkan password">
            </div>
            <button type="submit" class="btn btn-primary w-100">Masuk</button>
        </form>
    </div>
</body>
</html>
