<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Booking;
use App\Models\Course; // Asumsi kamu punya model Course
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // ==========================================
    // SISI MENTEE
    // ==========================================

    // 1. Menampilkan Halaman Form Booking
    public function create($mentor_id)
    {
        // Langsung panggil mentor beserta relasi kelas aslinya
        $mentor = User::with('mentoringClasses')->where('role', 'mentor')->findOrFail($mentor_id);
        
        return view('mentee.booking-form', compact('mentor'));
    }

    // 2. Memproses Data Booking yang di-Submit
    public function store(Request $request, $mentor_id)
    {
        // Validasi inputan form
        $validated = $request->validate([
            'mentoring_class_id' => 'required|exists:mentoring_classes,id',
            'booking_date' => 'required|date|after:today',
            'notes' => 'nullable|string|max:500',
        ]);

        // Simpan ke database
        Booking::create([
            'mentee_id' => Auth::id(), // ID mentee yang sedang login
            'mentor_id' => $mentor_id,
            'mentoring_class_id' => $validated['mentoring_class_id'],
            'booking_date' => $validated['booking_date'],
            'notes' => $validated['notes'],
            'status' => 'pending', // Status default
        ]);

        // Redirect ke halaman explore (atau nanti ke halaman riwayat booking)
        return redirect()->route('mentee.explore')->with('success', 'Booking berhasil diajukan! Menunggu konfirmasi mentor.');
    }

    // Menampilkan daftar riwayat booking milik Mentee
    public function index()
    {
        // Ambil data booking milik user yang sedang login, beserta data mentor dan kelasnya
        // latest() digunakan agar pesanan terbaru muncul paling atas.
        $bookings = Booking::with(['mentor', 'mentoringClass'])
            ->where('mentee_id', Auth::id())
            ->latest()
            ->get();

        return view('mentee.my-bookings', compact('bookings'));
    }

    // ==========================================
    // SISI MENTOR
    // ==========================================

    // 1. Menampilkan daftar permintaan bimbingan masuk
    public function mentorRequests()
    {
        // Ambil data di mana user yang login bertindak sebagai mentor
        $bookings = Booking::with(['mentee', 'mentoringClass'])
            ->where('mentor_id', Auth::id())
            ->latest()
            ->get();

        return view('mentor.requests', compact('bookings'));
    }

    // 2. Mengubah status bimbingan (Terima/Tolak)
    public function updateStatus(Request $request, Booking $booking)
    {
        // Keamanan ekstra: Pastikan yang mengubah status benar-benar mentor dari kelas tersebut
        if ($booking->mentor_id !== Auth::id()) {
            abort(403, 'Akses ditolak.');
        }

        // Validasi input status
        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected,completed'
        ]);

        // Update database
        $booking->update([
            'status' => $validated['status']
        ]);

        $pesan = $validated['status'] == 'accepted' ? 'Bimbingan berhasil diterima!' : 'Bimbingan telah ditolak.';

        return back()->with('success', $pesan);
    }
}