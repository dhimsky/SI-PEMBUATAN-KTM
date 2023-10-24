<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index () {
        $accountCount = User::where('role_id', '2')->count();
        $mahasiswaCount = Mahasiswa::count();
        $notcompleteCount = $accountCount - $mahasiswaCount;

        return view('admin.dashboard.index', compact('accountCount', 'mahasiswaCount', 'notcompleteCount'));
    }
}