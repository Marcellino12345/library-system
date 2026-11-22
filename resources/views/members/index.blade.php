@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')
    <h2>Data Anggota</h2>

    <form action="{{ route('members.store') }}" method="POST" novalidate>
        @csrf

        <div class="field">
            <label for="name">Nama</label>
            <input type="text" id="name" name="name"
                   class="@error('name') is-invalid @enderror"
                   value="{{ old('name') }}">
            @error('name')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="member_code">Kode Anggota</label>
            <input type="text" id="member_code" name="member_code"
                   class="@error('member_code') is-invalid @enderror"
                   value="{{ old('member_code') }}">
            @error('member_code')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="phone">Telepon</label>
            <input type="text" id="phone" name="phone"
                   class="@error('phone') is-invalid @enderror"
                   value="{{ old('phone') }}">
            @error('phone')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <div class="field">
            <label for="address">Alamat</label>
            <textarea id="address" name="address" rows="2"
                      class="@error('address') is-invalid @enderror">{{ old('address') }}</textarea>
            @error('address')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn">Tambah Anggota</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Alamat</th>
                <th>Peminjaman</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($members as $member)
                <tr>
                    <td>{{ $member->member_code }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->phone ?? '-' }}</td>
                    <td>{{ $member->address ?? '-' }}</td>
                    <td>{{ $member->borrowings_count }}</td>
                    <td>
                        <form action="{{ route('members.destroy', $member->id) }}" method="POST"
                              style="display:inline" onsubmit="return confirm('Hapus anggota ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada anggota.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection