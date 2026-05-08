<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Perpustakaan</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            position: relative;
            overflow: hidden;
        }

        /* Animated background circles */
        body::before,
        body::after {
            content: '';
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.15;
        }

        body::before {
            width: 600px;
            height: 600px;
            background: #4f46e5;
            top: -200px;
            right: -100px;
            animation: float 8s ease-in-out infinite;
        }

        body::after {
            width: 500px;
            height: 500px;
            background: #06b6d4;
            bottom: -200px;
            left: -100px;
            animation: float 10s ease-in-out infinite reverse;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(30px, -30px); }
        }

        .login-container {
            display: flex;
            width: 900px;
            max-width: 95vw;
            min-height: 520px;
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,0.4);
            border: 1px solid rgba(255,255,255,0.08);
            position: relative;
            z-index: 1;
            animation: slideUp 0.6s ease;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #4f46e5 0%, #0ea5e9 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 48px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            width: 300px;
            height: 300px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            top: -80px;
            right: -80px;
        }

        .login-left::after {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
            bottom: -60px;
            left: -60px;
        }

        .login-left .icon-container {
            width: 80px;
            height: 80px;
            background: rgba(255,255,255,0.2);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: white;
            margin-bottom: 24px;
            position: relative;
            z-index: 1;
        }

        .login-left h2 {
            color: white;
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
        }

        .login-left p {
            color: rgba(255,255,255,0.8);
            font-size: 14px;
            line-height: 1.7;
            max-width: 280px;
            position: relative;
            z-index: 1;
        }

        .login-right {
            flex: 1;
            padding: 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-right h3 {
            color: #f1f5f9;
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .login-right .subtitle {
            color: #94a3b8;
            font-size: 14px;
            margin-bottom: 32px;
        }

        .form-group-login {
            margin-bottom: 20px;
        }

        .form-group-login label {
            display: block;
            color: #94a3b8;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
            font-size: 14px;
        }

        .input-wrapper input {
            width: 100%;
            padding: 12px 16px 12px 44px;
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid rgba(148, 163, 184, 0.2);
            border-radius: 12px;
            font-size: 14px;
            color: #f1f5f9;
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }

        .input-wrapper input:focus {
            outline: none;
            border-color: #4f46e5;
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2);
        }

        .input-wrapper input::placeholder {
            color: #475569;
        }

        .remember-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .remember-row label {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #94a3b8;
            font-size: 13px;
            cursor: pointer;
        }

        .remember-row input[type="checkbox"] {
            accent-color: #4f46e5;
            width: 16px;
            height: 16px;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #4f46e5, #0ea5e9);
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 15px;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(79, 70, 229, 0.4);
        }

        .error-msg {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fca5a5;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .success-msg {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: #6ee7b7;
            padding: 12px 16px;
            border-radius: 10px;
            font-size: 13px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .login-footer {
            text-align: center;
            margin-top: 24px;
            color: #64748b;
            font-size: 12px;
        }

        @media (max-width: 768px) {
            .login-left { display: none; }
            .login-container { max-width: 420px; }
        }
    </style>
</head>
<body>

<div class="login-container">
    <div class="login-left">
        <div class="icon-container" style="background: white; padding: 5px;">
            <img src="{{ asset('images/LibraSys.png') }}" alt="LibraSys Logo" style="width: 100%; height: 100%; object-fit: contain; border-radius: 15px;">
        </div>
        <h2>Sistem Perpustakaan</h2>
        <p>Kelola perpustakaan sekolah dengan mudah dan modern. Peminjaman, pengembalian, dan manajemen buku dalam satu platform.</p>
    </div>

    <div class="login-right">
        <h3>Selamat Datang! 👋</h3>
        <p class="subtitle">Silakan login untuk mengakses dashboard</p>

        @if($errors->any())
            <div class="error-msg">
                <i class="fas fa-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('success'))
            <div class="success-msg">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group-login">
                <label>Email</label>
                <div class="input-wrapper">
                    <i class="fas fa-envelope"></i>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@perpustakaan.com" required autofocus>
                </div>
            </div>

            <div class="form-group-login">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Masukkan password" required>
                </div>
            </div>

            <div class="remember-row">
                <label>
                    <input type="checkbox" name="remember"> Ingat saya
                </label>
            </div>

            <button type="submit" class="btn-login">
                <i class="fas fa-sign-in-alt"></i>
                Login
            </button>
        </form>

        <div class="login-footer">
            &copy; {{ date('Y') }} Sistem Perpustakaan. All rights reserved.
        </div>
    </div>
</div>

</body>
</html>
