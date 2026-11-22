<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::withCount('borrowings')->orderBy('name')->get();

        return view('members.index', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|min:3|max:255',
            'member_code' => 'required|string|max:50|unique:members,member_code',
            'phone'       => 'nullable|string|max:20',
            'address'     => 'nullable|string|max:500',
        ], [
            'name.required'        => 'Nama anggota wajib diisi.',
            'name.min'             => 'Nama anggota minimal 3 karakter.',
            'member_code.required' => 'Kode anggota wajib diisi.',
            'member_code.unique'   => 'Kode anggota sudah terdaftar.',
            'phone.max'            => 'Nomor telepon maksimal 20 karakter.',
            'address.max'          => 'Alamat maksimal 500 karakter.',
        ]);

        Member::create($validated);

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function destroy(Member $member)
    {
        if ($member->borrowings()->exists()) {
            return redirect()->route('members.index')
                ->with('error', 'Anggota tidak dapat dihapus karena memiliki riwayat peminjaman.');
        }

        $member->delete();

        return redirect()->route('members.index')
            ->with('success', 'Anggota berhasil dihapus.');
    }
}