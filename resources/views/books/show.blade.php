<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Buku</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 30px auto; padding: 0 16px; }
        td { padding: 6px 12px 6px 0; }
    </style>
</head>
<body>
    <h1>Detail Buku</h1>

    <table>
        <tr><td><b>Judul</b></td><td>: {{ $book->title }}</td></tr>
        <tr><td><b>Penulis</b></td><td>: {{ $book->author }}</td></tr>
        <tr><td><b>Tahun</b></td><td>: {{ $book->year }}</td></tr>
        <tr><td><b>Stok</b></td><td>: {{ $book->stock }}</td></tr>
    </table>

    <p><a href="{{ route('books.index') }}">Kembali</a></p>
</body>
</html>