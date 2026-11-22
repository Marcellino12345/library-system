@extends('layouts.app')

@section('title', 'Peminjaman')

@section('content')
    <h2>Transaksi Peminjaman</h2>

    <a href="{{ route('borrowings.create') }}" class="btn">+ Peminjaman Baru</a>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Anggota</th>
                <th>Buku</th>
                <th>Tgl Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tgl Kembali</th>
                <th>Status</th>
                <th>Petugas</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($borrowings as $borrowing)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $borrowing->member->name }}</td>
                    <td>
                        @foreach ($borrowing->details as $detail)
                            {{ $detail->book->title }} ({{ $detail->quantity }})<br>
                        @endforeach
                    </td>
                    <td>{{ $borrowing->borrowing_date->format('d-m-Y') }}</td>
                    <td>{{ $borrowing->due_date->format('d-m-Y') }}</td>
                    <td>{{ $borrowing->return_date?->format('d-m-Y') ?? '-' }}</td>
                    <td>{{ $borrowing->status === 'borrowed' ? 'Dipinjam' : 'Dikembalikan' }}</td>
                    <td>{{ $borrowing->user->name }}</td>
                    <td>
                        @if ($borrowing->status === 'borrowed')
                            <form action="{{ route('borrowings.return', $borrowing->id) }}" method="POST"
                                  onsubmit="return confirm('Proses pengembalian buku ini?')">
                                @csrf
                                <button type="submit" class="btn btn-success">Kembalikan</button>
                            </form>
                        @else
                            -
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Belum ada transaksi peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection