<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Approve a mentor application.
     */
    public function approveMentor($userId)
    {
        $user = User::findOrFail($userId);

        // Check if user has pending status
        if ($user->mentor_status !== 'pending') {
            return redirect()->route('dashboard')->with('error', 'Pengajuan tidak valid.');
        }

        // Update user to mentor
        $user->update([
            'role' => 'mentor',
            'mentor_status' => 'approved',
        ]);

        return redirect()->route('dashboard')->with('success', "Pengajuan mentor dari {$user->name} telah disetujui!");
    }

    /**
     * Reject a mentor application.
     */
    public function rejectMentor($userId)
    {
        $user = User::findOrFail($userId);

        // Check if user has pending status
        if ($user->mentor_status !== 'pending') {
            return redirect()->route('dashboard')->with('error', 'Pengajuan tidak valid.');
        }

        // Update status to rejected
        $user->update([
            'mentor_status' => 'rejected',
        ]);

        return redirect()->route('dashboard')->with('success', "Pengajuan mentor dari {$user->name} telah ditolak.");
    }
}
