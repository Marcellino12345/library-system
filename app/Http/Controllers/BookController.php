<?php

namespace App\Http\Controllers;

class BookController extends Controller
{
    public function index()
    {
        $books = [
            ['id' => 1, 'title' => 'Pemrograman PHP', 'author' => 'Budi Raharjo', 'year' => 2020],
            ['id' => 2, 'title' => 'Laravel untuk Pemula', 'author' => 'Andi Wijaya', 'year' => 2022],
            ['id' => 3, 'title' => 'Basis Data', 'author' => 'Siti Nurhaliza', 'year' => 2019],
            ['id' => 4, 'title' => 'Algoritma dan Pemrograman', 'author' => 'Rinaldi Munir', 'year' => 2018],
            ['id' => 5, 'title' => 'Pemrograman Berorientasi Objek', 'author' => 'Dewi Lestari', 'year' => 2021],
            ['id' => 6, 'title' => 'Jaringan Komputer', 'author' => 'Eko Prasetyo', 'year' => 2017],
        ];

        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $stock = 7;

        return view('books.show', compact('id', 'stock'));
    }
}