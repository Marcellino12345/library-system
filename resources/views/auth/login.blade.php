<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Perpustakaan</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 60px auto; padding: 0 16px; }
        .field { margin-bottom: 14px; }
        label { display: block; font-weight: bold; margin-bottom: 4px; }
        input { width: 100%; padding: 8px; box-sizing: border-box; }
        .alert-error { background: #fdecea; border: 1px solid #c0392b; color: #c0392b; padding: 10px; margin: 12px 0; }
        .alert-error p { margin: 0; }
        .btn { padding: 8px 14px; background: #2563eb; color: #fff; border: 0; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Login Sistem Perpustakaan</h1>

    @if ($errors->any())
        <div class="alert-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <div class="field">
            <label for="email">Email</label>
            <input
                type="email"
                name="email"
                id="email"
                value="{{ old('email') }}"
                required
            >
        </div>

        <div class="field">
            <label for="password">Password</label>
            <input
                type="password"
                name="password"
                id="password"
                required
            >
        </div>

        <button type="submit" class="btn">Login</button>
    </form>
</body>
</html>