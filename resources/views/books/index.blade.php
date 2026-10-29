<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Buku - Library System</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 30px auto; padding: 0 16px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background: #f3f3f3; }
        .alert { background: #e6f7ea; border: 1px solid #2e8b57; color: #1e6b3f; padding: 10px; margin: 12px 0; }
        .btn { padding: 8px 14px; background: #2563eb; color: #fff; border: 0; text-decoration: none; cursor: pointer; }
        .btn-danger { background: #c0392b; padding: 4px 10px; }
        footer { margin-top: 30px; border-top: 1px solid #ccc; padding-top: 10px; color: #555; }
    </style>
</head>
<body>
    <h1>Library System</h1>
    <h2>Daftar Buku</h2>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <a href="{{ route('books.create') }}" class="btn">+ Tambah Buku</a>

    <table>
        <thead>
            <tr>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->year }}</td>
                    <td>{{ $book->stock }}</td>
                    <td>
                        <a href="{{ route('books.show', $book->id) }}">Detail</a> |
                        <a href="{{ route('books.edit', $book->id) }}">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                              style="display:inline" onsubmit="return confirm('Hapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data buku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <footer>&copy; 2026 Library System</footer>
</body>
</html>