<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
            <p class="text-gray-600 mt-2">Kelola sistem dan monitor aktivitas platform mentoring</p>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Pengguna</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_users'] }}</p>
                    </div>
                    <div class="text-blue-500 text-3xl">👥</div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Mentor</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_mentors'] }}</p>
                    </div>
                    <div class="text-green-500 text-3xl">🎓</div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Total Mentee</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['total_mentees'] }}</p>
                    </div>
                    <div class="text-purple-500 text-3xl">📚</div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 border-l-4 border-orange-500">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium">Booking Aktif</p>
                        <p class="text-3xl font-bold text-gray-900 mt-2">{{ $stats['active_bookings'] }}</p>
                    </div>
                    <div class="text-orange-500 text-3xl">📅</div>
                </div>
            </div>
        </div>

        <!-- Additional Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm font-medium">Mentor Pending</p>
                <p class="text-2xl font-bold text-yellow-600 mt-2">{{ $stats['pending_mentors'] }}</p>
                <a href="{{ route('admin.mentors', ['status' => 'pending']) }}" class="text-blue-600 text-sm mt-3 hover:underline inline-block">
                    Lihat detail →
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm font-medium">Total Booking</p>
                <p class="text-2xl font-bold text-blue-600 mt-2">{{ $stats['total_bookings'] }}</p>
                <a href="{{ route('admin.bookings') }}" class="text-blue-600 text-sm mt-3 hover:underline inline-block">
                    Lihat detail →
                </a>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <p class="text-gray-600 text-sm font-medium">Kategori Skill</p>
                <p class="text-2xl font-bold text-green-600 mt-2">{{ $stats['total_categories'] }}</p>
                <a href="{{ route('admin.categories') }}" class="text-blue-600 text-sm mt-3 hover:underline inline-block">
                    Kelola →
                </a>
            </div>
        </div>

        <!-- Quick Navigation -->
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-lg font-bold text-gray-900 mb-4">Navigasi Cepat</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.users') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition">
                    <span class="text-2xl mr-3">👤</span>
                    <span class="text-sm font-medium">Kelola User</span>
                </a>
                <a href="{{ route('admin.mentors') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition">
                    <span class="text-2xl mr-3">🎓</span>
                    <span class="text-sm font-medium">Verifikasi Mentor</span>
                </a>
                <a href="{{ route('admin.bookings') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition">
                    <span class="text-2xl mr-3">📅</span>
                    <span class="text-sm font-medium">Monitor Booking</span>
                </a>
                <a href="{{ route('admin.categories') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-blue-50 hover:border-blue-300 transition">
                    <span class="text-2xl mr-3">🏷️</span>
                    <span class="text-sm font-medium">Kategori</span>
                </a>
            </div>
        </div>

        <!-- Pending Mentors Section -->
        @if($pendingMentors->count() > 0)
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="p-6 border-b border-gray-200 bg-gray-50">
                    <h2 class="text-lg font-bold text-gray-900">Pengajuan Mentor Pending</h2>
                    <p class="text-gray-600 text-sm">{{ $pendingMentors->count() }} pengajuan menunggu verifikasi</p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kelas</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($pendingMentors as $mentor)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $mentor->name }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600">{{ $mentor->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-600">{{ $mentor->mentoringClasses->count() }} kelas</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        <div class="flex gap-2">
                                            <form action="{{ route('admin.mentor.approve', $mentor->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-green-600 hover:bg-green-700 text-white text-xs font-semibold rounded transition">
                                                    ✓ Setujui
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.mentor.reject', $mentor->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="inline-flex items-center px-3 py-1 bg-red-600 hover:bg-red-700 text-white text-xs font-semibold rounded transition" onclick="return confirm('Tolak pengajuan ini?')">
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
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                <p class="text-blue-900 font-medium">✓ Semua pengajuan mentor sudah diverifikasi</p>
            </div>
        @endif
    </div>
</div>
</x-app-layout>
