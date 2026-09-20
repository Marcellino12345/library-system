@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <h2>Daftar Buku</h2>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $book['title'] }}</td>
                    <td>{{ $book['author'] }}</td>
                    <td>{{ $book['year'] }}</td>
                    <td><a href="/books/{{ $book['id'] }}">Detail</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection