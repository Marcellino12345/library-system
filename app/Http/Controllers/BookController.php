<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules(), $this->messages());

        Book::create($validated);

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate($this->rules($book), $this->messages());

        $book->update($validated);

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Data buku berhasil dihapus.');
    }

    private function rules(?Book $book = null): array
    {
        return [
            'title' => [
                'required', 'string', 'min:3', 'max:255',
                Rule::unique('books', 'title')->ignore($book?->id),
            ],
            'author' => [
                'required', 'string', 'min:3', 'max:255',
                "regex:/^[\pL\s\.\,\'\-]+$/u",
            ],
            'year' => [
                'required', 'integer', 'digits:4', 'min:1900', 'max:' . date('Y'),
            ],
            'stock' => ['required', 'integer', 'min:0', 'max:10000'],
            'category_id' => ['required', 'exists:categories,id'],
        ];
    }

    private function messages(): array
    {
        return [
            'title.required'  => 'Judul buku wajib diisi.',
            'title.min'       => 'Judul buku minimal 3 karakter.',
            'title.max'       => 'Judul buku maksimal 255 karakter.',
            'title.unique'    => 'Judul buku sudah terdaftar.',
            'author.required' => 'Nama penulis wajib diisi.',
            'author.min'      => 'Nama penulis minimal 3 karakter.',
            'author.regex'    => 'Nama penulis hanya boleh berisi huruf dan tanda baca umum.',
            'year.required'   => 'Tahun terbit wajib diisi.',
            'year.integer'    => 'Tahun terbit harus berupa angka bulat.',
            'year.digits'     => 'Tahun terbit harus 4 digit.',
            'year.min'        => 'Tahun terbit minimal 1900.',
            'year.max'        => 'Tahun terbit tidak boleh melebihi tahun ini.',
            'stock.required'  => 'Stok wajib diisi.',
            'stock.integer'   => 'Stok harus berupa angka bulat.',
            'stock.min'       => 'Stok tidak boleh negatif.',
            'stock.max'       => 'Stok maksimal 10.000.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'category_id.exists'   => 'Kategori yang dipilih tidak tersedia.',
        ];
    }
}