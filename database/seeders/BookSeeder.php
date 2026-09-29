<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::create(['title' => 'Pemrograman PHP', 'author' => 'Budi Raharjo', 'year' => 2020, 'stock' => 5]);
        Book::create(['title' => 'Laravel untuk Pemula', 'author' => 'Andi Wijaya', 'year' => 2022, 'stock' => 8]);
        Book::create(['title' => 'Basis Data', 'author' => 'Siti Nurhaliza', 'year' => 2019, 'stock' => 3]);
        Book::create(['title' => 'Algoritma dan Pemrograman', 'author' => 'Rinaldi Munir', 'year' => 2018, 'stock' => 0]);
        Book::create(['title' => 'Pemrograman Berorientasi Objek', 'author' => 'Dewi Lestari', 'year' => 2021, 'stock' => 6]);
        Book::create(['title' => 'Jaringan Komputer', 'author' => 'Eko Prasetyo', 'year' => 2017, 'stock' => 2]);
    }
}