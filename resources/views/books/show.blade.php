@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
    <h2>Detail Buku</h2>
    <p>ID: {{ $book->id }}</p>
    <p>Judul: {{ $book->title }}</p>
    <p>Penulis: {{ $book->author }}</p>
    <p>Tahun Terbit: {{ $book->year }}</p>

    @if($book->stock > 0)
        <p>Buku tersedia. Stok: {{ $book->stock }}</p>
    @else
        <p>Buku sedang habis.</p>
    @endif

    <a href="/books">&larr; Kembali ke daftar buku</a>
@endsection