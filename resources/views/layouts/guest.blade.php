<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - {{ config('app.name', 'RS Baladhika Husada') }}</title>

    {{-- Bootstrap & Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        body {
            background: linear-gradient(135deg, #E6F4EA 0%, #ffffff 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .auth-card {
            max-width: 450px;
            width: 100%;
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }
        .auth-card:hover {
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            transform: scale(1.01);
        }
        .form-control:focus {
            border-color: #198754;
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25);
        }
        .input-group-text {
            background-color: #198754;
            color: white;
            border: 1px solid #198754;
        }
        .input-group-text i {
            width: 1rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="text-center mb-4">
            <a href="{{ url('/') }}" class="text-decoration-none d-block mb-2">
                <img src="{{ asset('images/logo.png') }}" alt="Logo RS" style="width: 200px; height: auto;">
            </a>
            <hr class="w-50 mx-auto">
        </div>
        
        {{ $slot }}
    </div>

    {{-- JS 1: Load Bootstrap JS (PENTING: Harus ada sebelum @stack) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    {{-- JS 2: Tempat Script dari halaman login --}}
    @stack('scripts')   
</body>
</html>