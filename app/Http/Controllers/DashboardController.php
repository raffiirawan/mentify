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
        $user = Auth::user();

        // ==========================================
        // JALUR 1: JIKA YANG LOGIN ADALAH MENTOR
        // ==========================================
        if ($user->role === 'mentor') {
            
            // Ambil data request yang masih pending
            $pendingRequests = Booking::with(['mentee', 'mentoringClass'])
                ->where('mentor_id', $user->id)
                ->where('status', 'pending')
                ->latest()
                ->get();

            // Ambil jadwal yang sudah disetujui
            $upcomingSchedules = Booking::with(['mentee', 'mentoringClass'])
                ->where('mentor_id', $user->id)
                ->where('status', 'accepted')
                ->whereDate('booking_date', '>=', now()) // Hanya jadwal hari ini & ke depan
                ->orderBy('booking_date', 'asc')
                ->get();

            // Asumsi file blade dashboard mentormu bernama 'mentor_dashboard.blade.php' 
            // (Sesuaikan nama 'mentor_dashboard' jika kamu menyimpannya dengan nama lain)
            return view('mentor/dashboard-content', compact('pendingRequests', 'upcomingSchedules'));
        }

        // ==========================================
        // JALUR 2: JIKA YANG LOGIN ADALAH MENTEE (Kode Lamamu)
        // ==========================================
        $userId = $user->id;

        // 1. Hitung Statistik (Quick Stats)
        $sesiAktif = Booking::where('mentee_id', $userId)->where('status', 'accepted')->count();
        $menungguKonfirmasi = Booking::where('mentee_id', $userId)->where('status', 'pending')->count();
        $totalJamBelajar = Booking::where('mentee_id', $userId)->where('status', 'completed')->count();

        // 2. Ambil Rekomendasi Mentor
        $rekomendasiMentors = User::where('role', 'mentor')
            ->whereHas('mentoringClasses')
            ->with(['mentoringClasses.category']) 
            ->inRandomOrder()
            ->take(3)
            ->get();

        // Mengarah ke dashboard mentee
        return view('mentee/dashboard-content', compact('sesiAktif', 'menungguKonfirmasi', 'totalJamBelajar', 'rekomendasiMentors'));
    }
}