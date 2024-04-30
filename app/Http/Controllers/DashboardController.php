<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Logika untuk menampilkan halaman dashboard
        return view('dashboard');
    }
}
