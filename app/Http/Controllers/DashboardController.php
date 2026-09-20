<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Library System Dashboard';
        $description = 'Selamat datang di Sistem Informasi Perpustakaan.';
        $totalBooks = 120;
        $totalMembers = 45;
        $totalCategories = 8;

        return view('dashboard.index', compact(
            'title',
            'description',
            'totalBooks',
            'totalMembers',
            'totalCategories'
        ));
    }
}