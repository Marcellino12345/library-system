@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2>{{ $title }}</h2>
    <p>{{ $description }}</p>

    <div class="cards">
        <div class="card">
            Jumlah Kategori
            <p class="num">{{ $totalCategories }}</p>
        </div>
        <div class="card">
            Jumlah Judul Buku
            <p class="num">{{ $totalBooks }}</p>
        </div>
        <div class="card">
            Total Stok Buku
            <p class="num">{{ $totalStock }}</p>
        </div>
        <div class="card">
            Jumlah Anggota
            <p class="num">{{ $totalMembers }}</p>
        </div>
        <div class="card">
            Total Peminjaman
            <p class="num">{{ $totalBorrowings }}</p>
        </div>
        <div class="card">
            Peminjaman Berjalan
            <p class="num">{{ $activeBorrowings }}</p>
        </div>
    </div>
@endsection