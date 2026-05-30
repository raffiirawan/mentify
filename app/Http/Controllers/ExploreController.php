<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class ExploreController extends Controller
{
    public function index(Request $request) 
    {
        $allCategories = \App\Models\Category::orderBy('name', 'asc')->get();

        // 1. Siapkan Query Dasar dengan Constrained Eager Loading
        $query = \App\Models\User::where('role', 'mentor')
            ->whereHas('mentoringClasses') // Pastikan dia punya kelas
            ->with(['mentoringClasses' => function ($q) use ($request) {
                // Saring juga data KELAS yang dibawa ke HTML agar harga min() nya akurat
                if ($request->filled('categories')) {
                    $q->whereIn('category_id', $request->categories);
                }
                if ($request->filled('price') && $request->price !== 'all') {
                    if ($request->price === 'low') {
                        $q->where('price_per_hour', '<', 30000);
                    } elseif ($request->price === 'mid') {
                        $q->whereBetween('price_per_hour', [30000, 50000]);
                    }
                }
            }, 'mentoringClasses.category']); // Bawa juga nama kategorinya

        // 2. Filter Search Bar (Berdasarkan Nama Mentor ATAU Kategori)
        if ($request->filled('search')) {
            $searchTerm = $request->search;
            
            $query->where(function ($q) use ($searchTerm) {
                // Skenario A: Cari nama mentornya
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  
                  // Skenario B: ATAU cari nama kategori di kelas yang dia miliki
                  ->orWhereHas('mentoringClasses.category', function ($subQ) use ($searchTerm) {
                      $subQ->where('name', 'like', '%' . $searchTerm . '%');
                  });
            });
        }

        // 3. Filter Kategori dan Harga (Sebagai Syarat Tampil Mentor)
        if ($request->filled('categories') || ($request->filled('price') && $request->price !== 'all')) {
            $query->whereHas('mentoringClasses', function ($q) use ($request) {
                if ($request->filled('categories')) {
                    $q->whereIn('category_id', $request->categories);
                }
                if ($request->filled('price') && $request->price !== 'all') {
                    if ($request->price === 'low') {
                        $q->where('price_per_hour', '<', 30000);
                    } elseif ($request->price === 'mid') {
                        $q->whereBetween('price_per_hour', [30000, 50000]);
                    }
                }
            });
        }

        $mentors = $query->get();

        return view('mentee.explore', compact('mentors', 'allCategories'));
    }
}
