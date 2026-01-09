<!DOCTYPE html>
<html>
<head>
    <title>Login Admin - Sembakoku</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 3rem 2.5rem;
            width: 100%;
            max-width: 450px;
            border-top: 4px solid #c62828;
        }

        .logo-section {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #e0e0e0;
        }

        .logo-text {
            font-size: 2.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.3rem;
            letter-spacing: 1px;
        }

        .logo-accent {
            color: #c62828;
        }

        .tagline {
            color: #7f8c8d;
            font-size: 0.9rem;
            font-weight: 400;
        }

        h2 {
            color: #2c3e50;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        .subtitle {
            color: #7f8c8d;
            margin-bottom: 2rem;
            font-size: 0.9rem;
        }

        .error-message {
            background-color: #ffebee;
            border: 1px solid #ef5350;
            color: #c62828;
            padding: 12px 15px;
            border-radius: 4px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
        }

        .error-message::before {
            content: '⚠';
            margin-right: 8px;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            color: #34495e;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #dcdcdc;
            border-radius: 4px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background-color: white;
            color: #2c3e50;
        }

        input[type="email"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: #c62828;
            box-shadow: 0 0 0 3px rgba(198, 40, 40, 0.1);
        }

        input::placeholder {
            color: #bdc3c7;
        }

        button[type="submit"] {
            width: 100%;
            padding: 13px;
            background-color: #c62828;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        button[type="submit"]:hover {
            background-color: #b71c1c;
            box-shadow: 0 4px 12px rgba(198, 40, 40, 0.3);
        }

        button[type="submit"]:active {
            transform: translateY(1px);
        }

        .footer-text {
            text-align: center;
            margin-top: 2rem;
            padding-top: 1.5rem;
            border-top: 1px solid #e0e0e0;
            color: #95a5a6;
            font-size: 0.85rem;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                padding: 2rem 1.5rem;
            }

            .logo-text {
                font-size: 2rem;
            }

            h2 {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo-text">
                Sem<span class="logo-accent">bako</span>ku
            </div>
            <p class="tagline">Sistem Informasi toko sembako</p>
        </div>

        <h2>Login Administrator</h2>
        <p class="subtitle">Silakan masuk menggunakan kredensial admin Anda</p>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.process') }}">
            @csrf

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="email" id="email" name="email" placeholder="admin@sembakoku.com" required>
            </div>

            <div class="form-group">
                <label for="password">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi" required>
            </div>

            <button type="submit">Masuk</button>
        </form>

        <div class="footer-text">
            © 2025 Sembakoku. Hak cipta dilindungi.
        </div>
    </div>
</body>
</html>