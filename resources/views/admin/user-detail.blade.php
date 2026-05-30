<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pengguna
        </h2>
    </x-slot>

<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Back Button -->
        <a href="{{ request()->referrer ?? route('admin.users') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 mb-8">
            ← Kembali
        </a>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- User Profile Card -->
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="text-center mb-6">
                        <div class="text-6xl mb-4">
                            @if($user->role === 'admin')
                                👨‍💼
                            @elseif($user->role === 'mentor')
                                🎓
                            @else
                                📚
                            @endif
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $user->name }}</h1>
                        <p class="text-gray-600">{{ $user->email }}</p>
                    </div>

                    <div class="space-y-3 border-t border-gray-200 pt-4">
                        <div>
                            <p class="text-gray-600 text-sm">Tipe Pengguna</p>
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full
                                @if($user->role === 'admin')
                                    bg-red-100 text-red-800
                                @elseif($user->role === 'mentor')
                                    bg-green-100 text-green-800
                                @else
                                    bg-blue-100 text-blue-800
                                @endif
                            ">
                                @if($user->role === 'admin')
                                    👨‍💼 Admin
                                @elseif($user->role === 'mentor')
                                    🎓 Mentor
                                @else
                                    📚 Mentee
                                @endif
                            </span>
                        </div>

                        <div>
                            <p class="text-gray-600 text-sm">Status</p>
                            @if($user->is_blocked)
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    🚫 Diblokir
                                </span>
                            @else
                                <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                    ✓ Aktif
                                </span>
                            @endif
                        </div>

                        @if($user->role === 'mentor')
                            <div>
                                <p class="text-gray-600 text-sm">Status Verifikasi</p>
                                @if($user->mentor_status === 'pending')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        ⏳ Pending
                                    </span>
                                @elseif($user->mentor_status === 'approved')
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        ✓ Approved
                                    </span>
                                @else
                                    <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                        ✕ Rejected
                                    </span>
                                @endif
                            </div>
                        @endif

                        <div>
                            <p class="text-gray-600 text-sm">Terdaftar</p>
                            <p class="font-medium">{{ $user->created_at->format('d M Y H:i') }}</p>
                        </div>

                        <div>
                            <p class="text-gray-600 text-sm">Terakhir Update</p>
                            <p class="font-medium">{{ $user->updated_at->format('d M Y H:i') }}</p>
                        </div>
                    </div>

                    @if($user->role !== 'admin')
                        <div class="border-t border-gray-200 mt-6 pt-6">
                            <form action="{{ route('admin.user.toggle-status', $user->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="w-full px-4 py-2 text-white text-sm font-semibold rounded-lg transition
                                    @if($user->is_blocked)
                                        bg-green-600 hover:bg-green-700
                                    @else
                                        bg-red-600 hover:bg-red-700
                                    @endif
                                " onclick="return confirm('Ubah status user ini?')">
                                    @if($user->is_blocked)
                                        ✓ Aktifkan User
                                    @else
                                        🚫 Blokir User
                                    @endif
                                </button>
                            </form>
                        </div>
                    @endif
                </div>
            </div>

            <!-- User Details & Bookings -->
            <div class="md:col-span-2">
                <!-- Bio & Portfolio (for Mentors) -->
                @if($user->role === 'mentor')
                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">Profil Mentor</h2>

                        <div class="space-y-4">
                            <div>
                                <p class="text-gray-600 text-sm font-medium">Bio</p>
                                <p class="text-gray-900 mt-1">{{ $user->bio ?? 'Belum diisi' }}</p>
                            </div>

                            <div>
                                <p class="text-gray-600 text-sm font-medium">Link Portfolio</p>
                                @if($user->portfolio_link)
                                    <a href="{{ $user->portfolio_link }}" target="_blank" class="text-blue-600 hover:text-blue-800 break-all">
                                        {{ $user->portfolio_link }}
                                    </a>
                                @else
                                    <p class="text-gray-500">Belum diisi</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Mentoring Classes -->
                    <div class="bg-white rounded-lg shadow p-6 mb-6">
                        <h2 class="text-lg font-bold text-gray-900 mb-4">
                            Kelas Mentoring ({{ $user->mentoringClasses->count() }})
                        </h2>

                        @if($user->mentoringClasses->count() > 0)
                            <div class="space-y-3">
                                @foreach($user->mentoringClasses as $class)
                                    <div class="border border-gray-200 rounded-lg p-4">
                                        <div class="flex items-start justify-between">
                                            <div>
                                                <h3 class="font-semibold text-gray-900">{{ $class->title }}</h3>
                                                <p class="text-sm text-gray-600 mt-1">{{ $class->description }}</p>
                                                <div class="flex gap-4 mt-2 text-sm">
                                                    <span class="text-gray-600">💰 Rp{{ number_format($class->price_per_hour, 0, ',', '.') }}/jam</span>
                                                    <span class="text-gray-600">
                                                        @if($class->is_active)
                                                            ✓ Aktif
                                                        @else
                                                            ✗ Nonaktif
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-4">Belum ada kelas mentoring</p>
                        @endif
                    </div>
                @endif

                <!-- Bookings -->
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-lg font-bold text-gray-900 mb-4">
                        Booking Terkait ({{ $bookings->count() }})
                    </h2>

                    @if($bookings->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead class="bg-gray-50 border-b border-gray-200">
                                    <tr>
                                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Tipe</th>
                                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Lawan</th>
                                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Status</th>
                                        <th class="px-4 py-2 text-left font-semibold text-gray-700">Jadwal</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($bookings as $booking)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-4 py-2">
                                                @if($booking->mentee_id === $user->id)
                                                    <span class="text-blue-600">📚 Sebagai Mentee</span>
                                                @else
                                                    <span class="text-green-600">🎓 Sebagai Mentor</span>
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">
                                                @if($booking->mentee_id === $user->id)
                                                    {{ $booking->mentor->name }}
                                                @else
                                                    {{ $booking->mentee->name }}
                                                @endif
                                            </td>
                                            <td class="px-4 py-2">
                                                @php
                                                    $statusColor = match($booking->status) {
                                                        'pending' => 'yellow',
                                                        'approved' => 'blue',
                                                        'completed' => 'green',
                                                        'cancelled' => 'red',
                                                        default => 'gray',
                                                    };
                                                @endphp
                                                <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800">
                                                    {{ ucfirst($booking->status) }}
                                                </span>
                                            </td>
                                            <td class="px-4 py-2 text-gray-600">
                                                @if($booking->booking_date)
                                                    {{ $booking->booking_date->format('d M Y') }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-4">Belum ada booking</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
