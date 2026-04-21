<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | The Newsroom</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Playfair+Display:wght@700;900&display=swap" rel="stylesheet">

    <style>
        body {
            background-color: #f4f4f4;
            background-image: radial-gradient(#d1d1d1 0.5px, transparent 0.5px);
            background-size: 20px 20px;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', sans-serif;
            color: #1a1a1a;
        }
        
        .login-container {
            width: 100%;
            max-width: 420px;
            animation: fadeIn 0.6s ease-out;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .login-card {
            border: none;
            border-radius: 4px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: #fff;
        }
        
        .login-header {
            background: #fff;
            padding: 50px 30px 20px;
            text-align: center;
            border-bottom: 1px solid #eee;
        }
        
        .login-header h2 {
            font-family: 'Playfair Display', serif;
            font-weight: 900;
            font-size: 2.2rem;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: -1px;
        }

        .login-header h2::after {
            content: '.';
            color: #c0392b;
        }
        
        .login-header p {
            font-size: 0.7rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            color: #95a5a6;
            font-weight: 700;
        }
        
        .login-body {
            padding: 40px 35px;
        }
        
        .form-label {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.65rem;
            letter-spacing: 1px;
            color: #1a1a1a;
            margin-bottom: 10px;
        }
        
        .form-control {
            border: 1.5px solid #eee;
            border-radius: 0;
            padding: 12px 15px;
            font-size: 0.9rem;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #c0392b;
            box-shadow: none;
            background-color: #fcfcfc;
        }

        .input-group {
            border: 1.5px solid #eee;
            transition: all 0.3s;
        }

        .input-group:focus-within {
            border-color: #c0392b;
        }

        .input-group .form-control {
            border: none;
        }
        
        .password-toggle {
            background: transparent;
            border: none;
            color: #95a5a6;
            padding: 0 15px;
        }
        
        .btn-login {
            background-color: #1a1a1a;
            border: none;
            border-radius: 0;
            padding: 14px;
            font-weight: 700;
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            width: 100%;
            color: white;
            transition: all 0.4s;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            background-color: #c0392b;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(192, 57, 43, 0.2);
            color: white;
        }
        
        .alert {
            font-size: 0.8rem;
            border-radius: 0;
            border-left: 4px solid #c0392b;
            background: #fff5f5;
            color: #c0392b;
        }

        .login-footer {
            background-color: #fafafa;
            padding: 25px;
            text-align: center;
            border-top: 1px solid #eee;
        }
        
        .login-footer .demo-note {
            margin: 0;
            color: #7f8c8d;
            font-size: 0.75rem;
            font-family: 'Inter', sans-serif;
            background: rgba(0,0,0,0.03);
            padding: 10px;
            border-radius: 4px;
            display: inline-block;
        }

        .demo-note strong {
            color: #1a1a1a;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="card login-card">
            <div class="login-header">
                <h2>Newsroom</h2>
                <p>Authorized Personnel Only</p>
            </div>
            
            <div class="login-body">
                @if ($errors->any())
                    <div class="alert">
                        @foreach ($errors->all() as $error)
                            <div><i class="bi bi-exclamation-circle me-2"></i> {{ $error }}</div>
                        @endforeach
                    </div>
                @endif
                
                <form action="{{ route('auth.login') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="email" class="form-label">Administrator Email</label>
                        <input 
                            type="email" 
                            class="form-control @error('email') is-invalid @enderror" 
                            id="email" 
                            name="email" 
                            placeholder="nama@cwnxtech.com"
                            value="{{ old('email') }}"
                            required
                        >
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label">Security Password</label>
                        <div class="input-group">
                            <input 
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                placeholder="••••••••"
                                required
                            >
                            <button 
                                class="password-toggle" 
                                type="button"
                                onclick="togglePassword()"
                            >
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-login">
                        Akses Dashboard <i class="bi bi-arrow-right ms-2"></i>
                    </button>
                </form>
            </div>
            
            <div class="login-footer">
                <p class="demo-note">
                    <strong>Demo :</strong> Email: <strong>grivin@gmail.com</strong>, password : <strong>12345678</strong>
                </p>
                <div class="mt-3" style="font-size: 0.65rem; color: #bdc3c7; text-transform: uppercase; letter-spacing: 1px;">
                    © {{ date('Y') }} CwnXtech-2418030 Ecosystem
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.replace('bi-eye', 'bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.replace('bi-eye-slash', 'bi-eye');
            }
        }
    </script>
</body>
</html>