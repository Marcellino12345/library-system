<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Pengguna - Library System</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 30px auto; padding: 0 16px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f3f3f3; }
        .btn { padding: 8px 14px; background: #2563eb; color: #fff; border: 0; text-decoration: none; cursor: pointer; }
        footer { margin-top: 30px; border-top: 1px solid #ccc; padding-top: 10px; color: #555; }
    </style>
</head>
<body>
    <h1>Library System</h1>
    <h2>Kelola Pengguna</h2>

    <a href="{{ route('books.index') }}" class="btn">Kembali ke Daftar Buku</a>

    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->role }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>&copy; 2026 Library System</footer>
</body>
</html>