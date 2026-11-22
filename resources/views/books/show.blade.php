@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
    <h2>Detail Buku</h2>

    <table>
        <tr>
            <th style="width:200px">Judul</th>
            <td>{{ $book->title }}</td>
        </tr>
        <tr>
            <th>Penulis</th>
            <td>{{ $book->author }}</td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td>{{ $book->category?->name ?? 'Belum ada kategori' }}</td>
        </tr>
        <tr>
            <th>Tahun Terbit</th>
            <td>{{ $book->year }}</td>
        </tr>
        <tr>
            <th>Stok</th>
            <td>{{ $book->stock }}</td>
        </tr>
    </table>

    <p style="margin-top:12px">
        <a href="{{ route('books.edit', $book->id) }}" class="btn">Edit</a>
        <a href="{{ route('books.index') }}">Kembali</a>
    </p>
@endsection