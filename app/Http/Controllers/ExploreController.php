<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class ExploreController extends Controller
{
    public function index(Request $request) 
    {
        // DEBUGGING 1: Cek apakah input masuk ke Controller
        // Lepas comment // di bawah ini kalau masih lolos juga
        // dd($request->all());

        $allCategories = \App\Models\Category::orderBy('name', 'asc')->get();

        // Siapkan Query Dasar
        $query = \App\Models\User::with(['mentoringClasses.category'])
                     ->where('role', 'mentor')
                     ->whereHas('mentoringClasses');

        // LOGIKA SEARCH BAR (Sudah dikembalikan)
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // LOGIKA FILTER KATEGORI & HARGA
        if ($request->filled('categories') || ($request->filled('price') && $request->price !== 'all')) {
            
            $query->whereHas('mentoringClasses', function ($q) use ($request) {
                
                // Filter Kategori
                if ($request->filled('categories')) {
                    $q->whereIn('category_id', $request->categories);
                }

                // Filter Harga
                if ($request->filled('price') && $request->price !== 'all') {
                    if ($request->price === 'low') {
                        $q->where('price_per_hour', '<', 30000);
                    } elseif ($request->price === 'mid') {
                        $q->whereBetween('price_per_hour', [30000, 50000]);
                    }
                }
            });
        }

        // DEBUGGING 2: Cek SQL aslinya (Khusus Laravel 10/11)
        // Lepas comment // di bawah ini untuk melihat query SQL murninya
        // dd($query->toRawSql());

        $mentors = $query->get();

        return view('mentee.explore', compact('mentors', 'allCategories'));
    }
}
