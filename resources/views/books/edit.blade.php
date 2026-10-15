@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
    <h2>Edit Buku</h2>

    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')

        <p>Judul: <input type="text" name="title" value="{{ $book->title }}"></p>
        <p>Penulis: <input type="text" name="author" value="{{ $book->author }}"></p>
        <p>Tahun Terbit: <input type="number" name="year" value="{{ $book->year }}"></p>
        <p>Stok: <input type="number" name="stock" value="{{ $book->stock }}"></p>

        <button type="submit">Update</button>
    </form>

    <a href="/books">&larr; Kembali ke daftar buku</a>
@endsection