@extends('layouts.app')

@section('title', 'Kategori Buku')

@section('content')
    <h2>Kategori Buku</h2>

    <form action="{{ route('categories.store') }}" method="POST" novalidate>
        @csrf
        <div class="field">
            <label for="name">Tambah Kategori</label>
            <input type="text" id="name" name="name"
                   class="@error('name') is-invalid @enderror"
                   value="{{ old('name') }}">
            @error('name')
                <p class="error-text">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit" class="btn">Simpan</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Jumlah Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->books_count }}</td>
                    <td>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                              style="display:inline" onsubmit="return confirm('Hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection