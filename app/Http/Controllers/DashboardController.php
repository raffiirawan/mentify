<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Booking;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Hitung Statistik (Quick Stats)
        // Menghitung jumlah booking berdasarkan statusnya
        $sesiAktif = Booking::where('mentee_id', $userId)->where('status', 'accepted')->count();
        $menungguKonfirmasi = Booking::where('mentee_id', $userId)->where('status', 'pending')->count();
        
        // Asumsi sementara: 1 sesi completed = 1 jam belajar
        $totalJamBelajar = Booking::where('mentee_id', $userId)->where('status', 'completed')->count();

        // 2. Ambil Rekomendasi Mentor
        // Mengambil 3 mentor secara acak (random) beserta data kelasnya
        $rekomendasiMentors = User::where('role', 'mentor')
            ->whereHas('mentoringClasses')
            ->with(['mentoringClasses.category']) 
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('dashboard', compact('sesiAktif', 'menungguKonfirmasi', 'totalJamBelajar', 'rekomendasiMentors'));
    }
}