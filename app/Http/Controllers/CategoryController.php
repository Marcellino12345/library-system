<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('books')->orderBy('name')->get();

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:categories,name',
        ], [
            'name.required' => 'Nama kategori wajib diisi.',
            'name.min'      => 'Nama kategori minimal 3 karakter.',
            'name.max'      => 'Nama kategori maksimal 255 karakter.',
            'name.unique'   => 'Nama kategori sudah terdaftar.',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy(Category $category)
    {
        if ($category->books()->exists()) {
            return redirect()->route('categories.index')
                ->with('error', 'Kategori tidak dapat dihapus karena masih dipakai oleh buku.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}