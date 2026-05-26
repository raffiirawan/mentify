<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MentorApplicationController extends Controller
{
    /**
     * Show the mentor application form.
     */
    public function create()
    {
        // Check if user already has pending or approved status
        $user = Auth::user();
        
        if ($user->role === 'mentor') {
            return redirect()->route('dashboard')->with('error', 'Anda sudah menjadi mentor.');
        }
        
        if ($user->mentor_status === 'pending') {
            return redirect()->route('dashboard')->with('info', 'Pengajuan Anda sedang diproses.');
        }
        
        return view('mentee.apply-mentor');
    }

    /**
     * Store the mentor application.
     */
    public function store(Request $request)
    {
        $request->validate([
            'bio' => 'required|string|min:10|max:1000',
            'portfolio_link' => 'required|url|max:255',
        ], [
            'bio.required' => 'Bio/Keahlian wajib diisi.',
            'bio.min' => 'Bio/Keahlian minimal 10 karakter.',
            'bio.max' => 'Bio/Keahlian maksimal 1000 karakter.',
            'portfolio_link.required' => 'Link Portofolio wajib diisi.',
            'portfolio_link.url' => 'Link Portofolio harus berupa URL yang valid.',
        ]);

        $user = Auth::user();

        // Update user data
        $user->update([
            'bio' => $request->bio,
            'portfolio_link' => $request->portfolio_link,
            'mentor_status' => 'pending',
        ]);

        return redirect()->route('dashboard')->with('success', 'Pengajuan mentor berhasil dikirim! Mohon tunggu persetujuan admin.');
    }
}
