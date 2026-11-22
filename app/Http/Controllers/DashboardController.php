<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Perpustakaan';
        $description = 'Ringkasan data Sistem Informasi Perpustakaan.';

        $totalCategories = Category::count();
        $totalBooks = Book::count();
        $totalStock = (int) Book::sum('stock');
        $totalMembers = Member::count();
        $totalBorrowings = Borrowing::count();
        $activeBorrowings = Borrowing::where('status', 'borrowed')->count();

        return view('dashboard.index', compact(
            'title',
            'description',
            'totalCategories',
            'totalBooks',
            'totalStock',
            'totalMembers',
            'totalBorrowings',
            'activeBorrowings'
        ));
    }
}