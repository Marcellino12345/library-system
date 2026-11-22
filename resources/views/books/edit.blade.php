@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
    <h2>Edit Buku</h2>

    <form action="{{ route('books.update', $book->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="field">
            <label for="title">Judul Buku</label>
            <input type="text" id="title" name="title"
                   class="@error('title') is-invalid @enderror"
                   value="{{ old('title', $book->title) }}">
            @error('title')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="author">Penulis</label>
            <input type="text" id="author" name="author"
                   class="@error('author') is-invalid @enderror"
                   value="{{ old('author', $book->author) }}">
            @error('author')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="year">Tahun Terbit</label>
            <input type="text" id="year" name="year"
                   class="@error('year') is-invalid @enderror"
                   value="{{ old('year', $book->year) }}">
            @error('year')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="stock">Stok</label>
            <input type="text" id="stock" name="stock"
                   class="@error('stock') is-invalid @enderror"
                   value="{{ old('stock', $book->stock) }}">
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
                        @selected(old('category_id', $book->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn">Perbarui</button>
        <a href="{{ route('books.index') }}">Kembali</a>
    </form>
@endsection