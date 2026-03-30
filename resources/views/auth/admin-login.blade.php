<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Kingswood Hotel and Suites</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Jost:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --color-primary: #A3815D;
            --color-secondary: #1A1A1A;
            --font-heading: 'Playfair Display', serif;
            --font-body: 'Jost', sans-serif;
        }
        
        body {
            font-family: var(--font-body);
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            color: #333;
        }
        
        .admin-login-wrapper {
            background: #fff;
            width: 100%;
            max-width: 450px;
            border-radius: 12px;
            box-shadow: 0 15px 50px rgba(0,0,0,0.1);
            overflow: hidden;
            border-top: 5px solid var(--color-primary);
        }

        @media (max-width: 768px) {
            .admin-login-wrapper {
                max-width: 340px;
            }
        }
        
        .admin-login-header {
            background: var(--color-secondary);
            color: #fff;
            text-align: center;
            padding: 2.5rem 2rem;
        }
        
        .admin-login-header h1 {
            font-family: var(--font-heading);
            margin: 0;
            font-size: 2rem;
            letter-spacing: 1px;
        }
        
        .admin-login-header p {
            margin: 0.5rem 0 0;
            color: rgba(255,255,255,0.7);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .admin-login-body {
            padding: 2.5rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
        }
        
        .form-control {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-family: var(--font-body);
            font-size: 1rem;
            transition: all 0.3s;
            box-sizing: border-box;
        }
        
        .form-control:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(163, 129, 93, 0.1);
        }
        
        .btn-login {
            width: 100%;
            background: var(--color-primary);
            color: #fff;
            border: none;
            padding: 1rem;
            font-family: var(--font-body);
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 1rem;
        }
        
        .btn-login:hover {
            background: #8c6e4d;
        }
        
        .error-message {
            background: #fee2e2;
            color: #dc2626;
            padding: 1rem;
            border-radius: 6px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            border-left: 4px solid #dc2626;
        }
        
        .back-link {
            display: block;
            text-align: center;
            margin-top: 1.5rem;
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s;
        }
        
        .back-link:hover {
            color: var(--color-primary);
        }
    </style>
</head>
<body>

<div class="admin-login-wrapper">
    <div class="admin-login-header">
        <h1>KINGSWOOD HOTEL AND SUITES</h1>
        <p>Staff Portal Access</p>
    </div>
    
    <div class="admin-login-body">
        @if ($errors->any())
            <div class="error-message">
                <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
            </div>
        @endif
        
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            
            <div class="form-group">
                <label for="email">Staff Email Address</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="admin@seapearl.com">
            </div>
            
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required placeholder="••••••••">
            </div>
            
            <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember" style="margin: 0; font-weight: 400; color: #666;">Keep me logged in</label>
            </div>
            
            <button type="submit" class="btn-login"><i class="fas fa-sign-in-alt mt-1 mr-2"></i> Access Dashboard</button>
        </form>
        
        <a href="{{ route('home') }}" class="back-link"><i class="fas fa-arrow-left"></i> Return to Main Site</a>
    </div>
</div>

</body>
</html>
