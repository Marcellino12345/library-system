<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member', 'user', 'details.book'])
            ->latest('id')
            ->get();

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $members = Member::orderBy('name')->get();
        $books = Book::where('stock', '>', 0)->orderBy('title')->get();

        return view('borrowings.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'items'     => 'nullable|array',
            'items.*'   => 'nullable|integer|min:0',
        ], [
            'member_id.required' => 'Anggota wajib dipilih.',
            'member_id.exists'   => 'Anggota yang dipilih tidak tersedia.',
            'items.*.integer'    => 'Jumlah buku harus berupa angka bulat.',
            'items.*.min'        => 'Jumlah buku tidak boleh negatif.',
        ]);

        // Ambil hanya buku dengan jumlah lebih dari 0.
        $items = collect($request->input('items', []))
            ->map(fn ($qty) => (int) $qty)
            ->filter(fn ($qty) => $qty > 0);

        if ($items->isEmpty()) {
            throw ValidationException::withMessages([
                'items' => 'Pilih minimal satu buku dengan jumlah lebih dari 0.',
            ]);
        }

        DB::transaction(function () use ($request, $items) {
            $borrowing = Borrowing::create([
                'user_id'        => auth()->id(),
                'member_id'      => $request->member_id,
                'borrowing_date' => now()->toDateString(),
                'due_date'       => now()->addDays(7)->toDateString(),
                'status'         => 'borrowed',
            ]);

            foreach ($items as $bookId => $qty) {
                $book = Book::lockForUpdate()->find($bookId);

                if (! $book) {
                    throw ValidationException::withMessages([
                        'items' => 'Buku yang dipilih tidak tersedia.',
                    ]);
                }

                if ($book->stock < $qty) {
                    throw ValidationException::withMessages([
                        'items' => "Stok buku \"{$book->title}\" tidak mencukupi (tersisa {$book->stock}).",
                    ]);
                }

                $borrowing->details()->create([
                    'book_id'  => $book->id,
                    'quantity' => $qty,
                ]);

                $book->decrement('stock', $qty);
            }
        });

        return redirect()->route('borrowings.index')
            ->with('success', 'Transaksi peminjaman berhasil disimpan dan stok buku diperbarui.');
    }

    public function returnBook(Borrowing $borrowing)
    {
        DB::transaction(function () use ($borrowing) {
            $current = Borrowing::lockForUpdate()->findOrFail($borrowing->id);

            if ($current->status !== 'borrowed') {
                return;
            }

            $current->update([
                'return_date' => now()->toDateString(),
                'status'      => 'returned',
            ]);

            foreach ($current->details()->with('book')->get() as $detail) {
                $detail->book->increment('stock', $detail->quantity);
            }
        });

        return redirect()->route('borrowings.index')
            ->with('success', 'Buku berhasil dikembalikan dan stok buku bertambah.');
    }
}