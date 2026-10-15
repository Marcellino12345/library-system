@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <h2>Tambah Buku</h2>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf

        <p>Judul: <input type="text" name="title"></p>
        <p>Penulis: <input type="text" name="author"></p>
        <p>Tahun Terbit: <input type="number" name="year"></p>
        <p>Stok: <input type="number" name="stock"></p>

        <button type="submit">Simpan</button>
    </form>

    <a href="/books">&larr; Kembali ke daftar buku</a>
@endsection