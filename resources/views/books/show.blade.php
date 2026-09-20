@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
    <h2>Detail Buku</h2>
    <p>ID: {{ $id }}</p>

    @if($stock > 0)
        <p>Buku tersedia. Stok: {{ $stock }}</p>
    @else
        <p>Buku sedang habis.</p>
    @endif

    <a href="/books">&larr; Kembali ke daftar buku</a>
@endsection