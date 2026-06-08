<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Admin Dashboard Content - Do NOT wrap in <x-app-layout> --}}
                    {{-- This file is included by dashboard.blade.php which already has the layout wrapper --}}

                    {{-- ============================================
                        BAGIAN 1: HEADER
                        ============================================ --}}
                    <div class="mb-8">
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Dashboard Admin</h1>
                        <p class="text-lg text-gray-600">Kelola sistem dan monitor aktivitas platform mentoring</p>
                    </div>

                    {{-- ============================================
                        BAGIAN 2: STATISTICS GRID
                        ============================================ --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        
                        {{-- Stat Card: Total Users --}}
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Total Users</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_users'] }}</p>
                                </div>
                                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4 flex items-center text-sm">
                                <span class="text-gray-600">Mentors: <span class="font-semibold text-gray-900">{{ $stats['total_mentors'] }}</span></span>
                                <span class="mx-2 text-gray-400">•</span>
                                <span class="text-gray-600">Mentees: <span class="font-semibold text-gray-900">{{ $stats['total_mentees'] }}</span></span>
                            </div>
                        </div>

                        {{-- Stat Card: Pending Mentors --}}
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Pending Mentors</p>
                                    <p class="text-3xl font-bold text-amber-600">{{ $stats['pending_mentors'] }}</p>
                                </div>
                                <div class="w-12 h-12 bg-amber-50 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            </div>
                            @if($stats['pending_mentors'] > 0)
                                <div class="mt-4">
                                    <a href="{{ route('admin.mentors') }}?status=pending" class="text-sm text-amber-700 hover:text-amber-800 font-medium inline-flex items-center">
                                        Tinjau sekarang
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                        </svg>
                                    </a>
                                </div>
                            @else
                                <p class="mt-4 text-sm text-gray-500">Semua terverifikasi ✓</p>
                            @endif
                        </div>

                        {{-- Stat Card: Total Bookings --}}
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Total Bookings</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_bookings'] }}</p>
                                </div>
                                <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <span class="text-sm text-gray-600">Aktif: <span class="font-semibold text-green-600">{{ $stats['active_bookings'] }}</span></span>
                            </div>
                        </div>

                        {{-- Stat Card: Categories --}}
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-gray-600 mb-1">Kategori</p>
                                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total_categories'] }}</p>
                                </div>
                                <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                </div>
                            </div>
                            <div class="mt-4">
                                <a href="{{ route('admin.categories') }}" class="text-sm text-green-700 hover:text-green-800 font-medium inline-flex items-center">
                                    Kelola kategori
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            </div>
                        </div>

                    </div>

                    {{-- ============================================
                        BAGIAN 3: QUICK ACTIONS GRID
                        ============================================ --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                        
                        <a href="{{ route('admin.users') }}" class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-6 shadow-sm hover:shadow-lg transition-all hover:-translate-y-1">
                            <div class="text-white">
                                <div class="text-3xl mb-3">👥</div>
                                <h3 class="text-lg font-bold mb-1">Kelola Users</h3>
                                <p class="text-sm text-blue-100">Lihat semua pengguna</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.mentors') }}" class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-6 shadow-sm hover:shadow-lg transition-all hover:-translate-y-1">
                            <div class="text-white">
                                <div class="text-3xl mb-3">🎓</div>
                                <h3 class="text-lg font-bold mb-1">Kelola Mentor</h3>
                                <p class="text-sm text-green-100">Verifikasi & monitor</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.bookings') }}" class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-6 shadow-sm hover:shadow-lg transition-all hover:-translate-y-1">
                            <div class="text-white">
                                <div class="text-3xl mb-3">📅</div>
                                <h3 class="text-lg font-bold mb-1">Monitor Booking</h3>
                                <p class="text-sm text-purple-100">Lihat semua booking</p>
                            </div>
                        </a>

                        <a href="{{ route('admin.categories') }}" class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-6 shadow-sm hover:shadow-lg transition-all hover:-translate-y-1">
                            <div class="text-white">
                                <div class="text-3xl mb-3">🏷️</div>
                                <h3 class="text-lg font-bold mb-1">Kelola Kategori</h3>
                                <p class="text-sm text-amber-100">Edit kategori skill</p>
                            </div>
                        </a>

                    </div>

                    {{-- ============================================
                        BAGIAN 4: PENDING MENTORS TABLE
                        ============================================ --}}
                    @if($pendingMentors->count() > 0)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="bg-gradient-to-r from-amber-50 to-orange-50 px-6 py-4 border-b border-amber-100">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h2 class="text-xl font-bold text-gray-900">⏳ Pengajuan Mentor Pending</h2>
                                        <p class="text-sm text-gray-600 mt-1">{{ $pendingMentors->count() }} pengajuan memerlukan persetujuan Anda</p>
                                    </div>
                                    <a href="{{ route('admin.mentors') }}?status=pending" class="text-sm text-amber-700 hover:text-amber-800 font-medium">
                                        Lihat Semua →
                                    </a>
                                </div>
                            </div>

                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50 border-b border-gray-200">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Terdaftar</th>
                                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kelas Disiapkan</th>
                                            <th class="px-6 py-3 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @foreach($pendingMentors as $mentor)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="flex items-center">
                                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center mr-3">
                                                            <span class="text-sm font-bold text-blue-700">{{ strtoupper(substr($mentor->name, 0, 2)) }}</span>
                                                        </div>
                                                        <div>
                                                            <div class="text-sm font-medium text-gray-900">{{ $mentor->name }}</div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-600">{{ $mentor->email }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <div class="text-sm text-gray-600">{{ $mentor->created_at->diffForHumans() }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                                        {{ $mentor->mentoringClasses->count() }} kelas
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    <div class="flex items-center justify-center gap-2">
                                                        <form action="{{ route('admin.mentor.approve', $mentor->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded-lg transition shadow-sm hover:shadow">
                                                                ✓ Setujui
                                                            </button>
                                                        </form>
                                                        <form action="{{ route('admin.mentor.reject', $mentor->id) }}" method="POST" class="inline">
                                                            @csrf
                                                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded-lg transition shadow-sm hover:shadow" onclick="return confirm('Yakin ingin menolak pengajuan {{ $mentor->name }}?')">
                                                                ✕ Tolak
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @else
                        <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl p-8 text-center">
                            <div class="text-5xl mb-4">✓</div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Semua Pengajuan Terverifikasi!</h3>
                            <p class="text-gray-600">Tidak ada pengajuan mentor yang menunggu persetujuan saat ini.</p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>