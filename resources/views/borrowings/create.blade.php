@extends('layouts.app')

@section('title', 'Peminjaman Baru')

@section('content')
    <h2>Peminjaman Baru</h2>

    @if ($errors->any())
        <div class="alert-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('borrowings.store') }}" method="POST" novalidate>
        @csrf

        <div class="field">
            <label for="member_id">Anggota</label>
            <select id="member_id" name="member_id"
                    class="@error('member_id') is-invalid @enderror">
                <option value="">Pilih anggota</option>
                @foreach ($members as $member)
                    <option value="{{ $member->id }}"
                        @selected(old('member_id') == $member->id)>
                        {{ $member->member_code }} - {{ $member->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <p><strong>Pilih buku</strong> (isi jumlah pada buku yang dipinjam, biarkan 0 jika tidak dipinjam)</p>

        <table>
            <thead>
                <tr>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Stok</th>
                    <th style="width:110px">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->stock }}</td>
                        <td>
                            <input type="number" name="items[{{ $book->id }}]"
                                   min="0" max="{{ $book->stock }}"
                                   value="{{ old('items.' . $book->id, 0) }}">
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">Tidak ada buku dengan stok tersedia.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <p style="margin-top:12px">Lama peminjaman: 7 hari sejak hari ini.</p>

        <button type="submit" class="btn">Simpan Transaksi</button>
        <a href="{{ route('borrowings.index') }}">Batal</a>
    </form>
@endsection