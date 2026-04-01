<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - TokoKu</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f5f5; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .box { background: white; border-radius: 20px; padding: 40px; width: 100%; max-width: 420px; margin: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.08); }
        .logo { display: flex; align-items: center; gap: 10px; margin-bottom: 28px; }
        .logo-icon { font-size: 28px; }
        .logo-title { font-size: 22px; font-weight: 800; color: #FF6B35; }
        h2 { font-size: 20px; font-weight: 700; color: #1a1f2e; margin-bottom: 6px; }
        .sub { font-size: 13px; color: #aaa; margin-bottom: 24px; }
        .alert { background: #fff2f2; border: 1px solid #ffcdd2; border-radius: 10px; padding: 12px 16px; color: #c62828; font-size: 13px; margin-bottom: 20px; }
        .alert-success { background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 10px; padding: 12px 16px; color: #166534; font-size: 13px; margin-bottom: 20px; }
        .field { margin-bottom: 16px; }
        .field label { display: block; font-size: 12px; font-weight: 600; color: #555; margin-bottom: 6px; }
        .field input { width: 100%; padding: 12px 14px; border: 1.5px solid #e8e8e8; border-radius: 10px; font-size: 14px; outline: none; background: #fafafa; }
        .field input:focus { border-color: #FF6B35; background: white; }
        .btn { width: 100%; padding: 13px; background: #FF6B35; color: white; border: none; border-radius: 10px; font-size: 15px; font-weight: 700; cursor: pointer; transition: 0.2s; }
        .btn:hover { background: #e55a25; }
        .register-link { text-align: center; margin-top: 20px; font-size: 13px; color: #aaa; }
        .register-link a { color: #FF6B35; text-decoration: none; font-weight: 600; }
        .back-link { text-align: center; margin-top: 12px; font-size: 13px; }
        .back-link a { color: #aaa; text-decoration: none; }
        .back-link a:hover { color: #FF6B35; }
    </style>
</head>
<body>
<div class="box">
    <div class="logo">
        <div class="logo-icon">🛍️</div>
        <div class="logo-title">TokoKu</div>
    </div>
    <h2>Selamat Datang! 👋</h2>
    <p class="sub">Masuk untuk mulai belanja</p>

    @if($errors->any())
        <div class="alert">{{ $errors->first() }}</div>
    @endif
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('user.login.post') }}">
        @csrf
        <div class="field">
            <label>EMAIL</label>
            <input type="email" name="email" placeholder="contoh@email.com" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="field">
            <label>KATA SANDI</label>
            <input type="password" name="password" placeholder="••••••••" required>
        </div>
        <button type="submit" class="btn">Masuk Sekarang</button>
    </form>

    <div class="register-link">
        Belum punya akun? <a href="{{ route('register') }}">Daftar Gratis</a>
    </div>
    <div class="back-link">
        <a href="{{ route('/') }}">← Kembali ke Toko</a>
    </div>
</div>
</body>
</html>
