<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Library System</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 960px; margin: 0 auto; padding: 0 16px; }
        header { padding-top: 20px; }
        header h1 { margin: 0 0 10px; }
        nav { display: flex; flex-wrap: wrap; gap: 6px; align-items: center; }
        nav a { padding: 6px 12px; background: #f3f3f3; color: #222; text-decoration: none; border: 1px solid #ccc; }
        nav a.active { background: #2563eb; color: #fff; border-color: #2563eb; }
        .userbar { display: flex; justify-content: space-between; align-items: center; margin-top: 10px; color: #555; font-size: 14px; }
        .userbar form { margin: 0; }
        hr { border: 0; border-top: 1px solid #ccc; margin: 12px 0; }
        main { padding: 8px 0 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f3f3f3; }
        .alert { background: #e6f7ea; border: 1px solid #2e8b57; color: #1e6b3f; padding: 10px; margin: 12px 0; }
        .alert-error { background: #fdecea; border: 1px solid #c0392b; color: #c0392b; padding: 10px; margin: 12px 0; }
        .alert-error p { margin: 0; }
        .field { margin-bottom: 14px; }
        label { display: block; font-weight: bold; margin-bottom: 4px; }
        input, select, textarea { width: 100%; padding: 8px; box-sizing: border-box; font-family: inherit; }
        .is-invalid { border: 1px solid #c0392b; }
        .error-text { color: #c0392b; font-size: 14px; margin: 4px 0 0; }
        .btn { padding: 8px 14px; background: #2563eb; color: #fff; border: 0; text-decoration: none; cursor: pointer; display: inline-block; font-size: 14px; }
        .btn-danger { background: #c0392b; padding: 4px 10px; }
        .btn-success { background: #2e8b57; padding: 4px 10px; }
        .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(170px, 1fr)); gap: 12px; margin-top: 12px; }
        .card { border: 1px solid #ccc; padding: 14px; background: #fafafa; }
        .card .num { font-size: 28px; font-weight: bold; margin: 4px 0 0; }
        footer p { color: #555; margin: 0; padding-bottom: 20px; }
    </style>
</head>
<body>
    <header>
        <h1>Library System</h1>
        <nav>
            <a href="/dashboard" class="{{ request()->is('dashboard*') ? 'active' : '' }}">Dashboard</a>
            <a href="/categories" class="{{ request()->is('categories*') ? 'active' : '' }}">Kategori</a>
            <a href="/books" class="{{ request()->is('books*') ? 'active' : '' }}">Buku</a>
            <a href="/members" class="{{ request()->is('members*') ? 'active' : '' }}">Anggota</a>
            <a href="/borrowings" class="{{ request()->is('borrowings*') ? 'active' : '' }}">Peminjaman</a>
            <a href="/users" class="{{ request()->is('users*') ? 'active' : '' }}">Kelola Pengguna</a>
        </nav>
        <div class="userbar">
            <span>Login sebagai: {{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>
        <hr>
    </header>

    <main>
        @if (session('success'))
            <div class="alert">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert-error"><p>{{ session('error') }}</p></div>
        @endif

        @yield('content')
    </main>

    <footer>
        <hr>
        <p>&copy; 2026 Library System</p>
    </footer>
</body>
</html>