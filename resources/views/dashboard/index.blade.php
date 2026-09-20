@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2>{{ $title }}</h2>
    <p>{{ $description }}</p>

    <ul>
        <li>Jumlah Buku: {{ $totalBooks }}</li>
        <li>Jumlah Member: {{ $totalMembers }}</li>
        <li>Jumlah Kategori: {{ $totalCategories }}</li>
    </ul>
@endsection