<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show admin dashboard
     */
    public function dashboard()
    {
        $stats = [
            'total_users' => User::count(),
            'total_mentors' => User::where('role', 'mentor')->count(),
            'total_mentees' => User::where('role', 'mentee')->count(),
            'pending_mentors' => User::where('mentor_status', 'pending')->count(),
            'total_bookings' => Booking::count(),
            'total_categories' => Category::count(),
            'active_bookings' => Booking::whereIn('status', ['pending', 'approved'])->count(),
        ];

        $pendingMentors = User::where('mentor_status', 'pending')
            ->with('mentoringClasses')
            ->latest()
            ->get();

        return view('admin.dashboard-content', compact('stats', 'pendingMentors'));
    }

    /**
     * Show user management page
     */
    public function users(Request $request)
    {
        $query = User::query();

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Search by name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $users = $query->latest()->paginate(15);

        return view('admin.users', compact('users'));
    }

    /**
     * Show mentor verification page
     */
    public function mentors(Request $request)
    {
        $query = User::where('role', 'mentor')->with('mentoringClasses');

        if ($request->filled('status')) {
            $query->where('mentor_status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%');
            });
        }

        $mentors = $query->latest()->paginate(15);

        return view('admin.mentors', compact('mentors'));
    }

    /**
     * Show booking management page
     */
    public function bookings(Request $request)
    {
        $query = Booking::with('mentee', 'mentor')
            ->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->paginate(15);

        return view('admin.bookings', compact('bookings'));
    }

    /**
     * Show category management page
     */
    public function categories(Request $request)
    {
        $categories = Category::withCount('mentoringClasses')
            ->latest()
            ->paginate(15);

        return view('admin.categories', compact('categories'));
    }

    /**
     * Create new category
     */
    public function storeCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name',
            'slug' => 'required|string|max:100|unique:categories,slug',
            'icon' => 'nullable|string|max:50',
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Update category
     */
    public function updateCategory(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100|unique:categories,name,' . $category->id,
            'slug' => 'required|string|max:100|unique:categories,slug,' . $category->id,
            'icon' => 'nullable|string|max:50',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Delete category
     */
    public function deleteCategory(Category $category)
    {
        if ($category->mentoringClasses()->exists()) {
            return redirect()->route('admin.categories')
                ->with('error', 'Kategori tidak bisa dihapus karena masih memiliki kelas mentoring.');
        }

        $category->delete();

        return redirect()->route('admin.categories')
            ->with('success', 'Kategori berhasil dihapus.');
    }

    /**
     * Approve a mentor application.
     */
    public function approveMentor($userId)
    {
        $user = User::findOrFail($userId);

        if ($user->mentor_status !== 'pending') {
            return redirect()->back()->with('error', 'Pengajuan tidak valid.');
        }

        $user->update([
            'role' => 'mentor',
            'mentor_status' => 'approved',
        ]);

        return redirect()->back()
            ->with('success', "Pengajuan mentor dari {$user->name} telah disetujui!");
    }

    /**
     * Reject a mentor application.
     */
    public function rejectMentor($userId)
    {
        $user = User::findOrFail($userId);

        if ($user->mentor_status !== 'pending') {
            return redirect()->back()->with('error', 'Pengajuan tidak valid.');
        }

        $user->update([
            'mentor_status' => 'rejected',
        ]);

        return redirect()->back()
            ->with('success', "Pengajuan mentor dari {$user->name} telah ditolak.");
    }

    /**
     * Block/Unblock user
     */
    public function toggleUserStatus(User $user)
    {
        if ($user->role === 'admin') {
            return redirect()->back()->with('error', 'Tidak dapat mengubah status admin.');
        }

        $user->is_blocked = !$user->is_blocked;
        $user->save();

        $status = $user->is_blocked ? 'diblokir' : 'diaktifkan';
        return redirect()->back()
            ->with('success', "User {$user->name} telah {$status}.");
    }

    /**
     * View user detail
     */
    public function userDetail(User $user)
    {
        $bookings = Booking::where('mentee_id', $user->id)
            ->orWhere('mentor_id', $user->id)
            ->latest()
            ->get();

        return view('admin.user-detail', compact('user', 'bookings'));
    }
}
