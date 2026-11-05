<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Buku</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 30px auto; padding: 0 16px; }
        .field { margin-bottom: 14px; }
        label { display: block; font-weight: bold; margin-bottom: 4px; }
        input, select { width: 100%; padding: 8px; box-sizing: border-box; }
        .is-invalid { border: 1px solid #c0392b; }
        .error-text { color: #c0392b; font-size: 14px; margin: 4px 0 0; }
        .btn { padding: 8px 14px; background: #2563eb; color: #fff; border: 0; cursor: pointer; }
    </style>
</head>
<body>
    <h1>Tambah Buku</h1>

    <form action="{{ route('books.store') }}" method="POST" novalidate>
        @csrf

        <div class="field">
            <label for="title">Judul Buku</label>
            <input type="text" id="title" name="title"
                   class="@error('title') is-invalid @enderror"
                   value="{{ old('title') }}">
            @error('title')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="author">Penulis</label>
            <input type="text" id="author" name="author"
                   class="@error('author') is-invalid @enderror"
                   value="{{ old('author') }}">
            @error('author')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="year">Tahun Terbit</label>
            <input type="text" id="year" name="year"
                   class="@error('year') is-invalid @enderror"
                   value="{{ old('year') }}">
            @error('year')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="stock">Stok</label>
            <input type="text" id="stock" name="stock"
                   class="@error('stock') is-invalid @enderror"
                   value="{{ old('stock') }}">
            @error('stock')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="category_id">Kategori</label>
            <select id="category_id" name="category_id"
                    class="@error('category_id') is-invalid @enderror">
                <option value="">Pilih kategori</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        @selected(old('category_id') == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn">Simpan</button>
        <a href="{{ route('books.index') }}">Kembali</a>
    </form>
</body>
</html>