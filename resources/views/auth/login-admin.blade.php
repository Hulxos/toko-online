<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - TokoKu</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: white; padding: 40px; border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,0.1); width: 100%; max-width: 350px; }
        .login-card h2 { text-align: center; color: #1c1e21; margin-bottom: 25px; }
        .form-group { margin-bottom: 15px; }
        input { width: 100%; padding: 12px; border: 1px solid #dddfe2; border-radius: 6px; font-size: 14px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #1877f2; color: white; border: none; border-radius: 6px; font-size: 16px; font-weight: bold; cursor: pointer; transition: 0.3s; }
        button:hover { background: #166fe5; }
        .error-msg { color: #f02849; font-size: 13px; text-align: center; margin-bottom: 15px; padding: 10px; background: #ffe9ec; border-radius: 6px; border: 1px solid #f02849; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Admin Panel</h2>

        {{-- Menampilkan Pesan Error --}}
        @if($errors->any())
            <div class="error-msg">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('error'))
            <div class="error-msg">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <div class="form-group">
                {{-- name diganti jadi email supaya sinkron dengan database --}}
                <input type="email" name="email" placeholder="Email Admin (admin@gmail.com)" value="{{ old('email') }}" required autofocus>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>