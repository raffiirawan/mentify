<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Bimbingan Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-900">Daftar Pengajuan Kelas</h1>
                <p class="text-gray-600 mt-2">Pantau status permintaan bimbinganmu kepada mentor di sini.</p>
            </div>

            <div class="space-y-6">
                @forelse($bookings as $booking)
                    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row gap-6 items-start md:items-center hover:shadow-md transition">
                        
                        {{-- Info Mentor & Kelas --}}
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center">
                                    {{ strtoupper(substr($booking->mentor->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-lg">{{ $booking->mentor->name }}</h3>
                                    <p class="text-sm text-gray-500">Mentor</p>
                                </div>
                            </div>
                            <h4 class="text-xl font-bold text-mentify-blue mt-3">
                                {{ $booking->mentoringClass->title ?? 'Kelas Telah Dihapus' }}
                            </h4>
                        </div>

                        {{-- Jadwal & Status --}}
                        <div class="flex flex-col gap-3 md:items-end w-full md:w-auto bg-gray-50 p-4 rounded-xl border border-gray-100">
                            
                            {{-- Badge Status Dinamis --}}
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                    'accepted' => 'bg-green-100 text-green-800 border-green-200',
                                    'rejected' => 'bg-red-100 text-red-800 border-red-200',
                                    'completed' => 'bg-blue-100 text-blue-800 border-blue-200',
                                ];
                                $statusLabels = [
                                    'pending' => 'Menunggu Konfirmasi',
                                    'accepted' => 'Diterima Mentor',
                                    'rejected' => 'Ditolak',
                                    'completed' => 'Selesai',
                                ];
                                
                                $colorClass = $statusColors[$booking->status] ?? 'bg-gray-100 text-gray-800 border-gray-200';
                                $label = $statusLabels[$booking->status] ?? ucfirst($booking->status);
                            @endphp
                            
                            <span class="px-4 py-1.5 rounded-full text-sm font-bold border {{ $colorClass }} inline-block text-center w-full md:w-auto">
                                {{ $label }}
                            </span>

                            <div class="text-sm text-gray-600 flex items-center gap-2 mt-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y - H:i') }}
                            </div>
                        </div>

                    </div>
                @empty
                    <div class="bg-white rounded-2xl shadow-sm border border-dashed border-gray-300 p-12 text-center">
                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada riwayat bimbingan</h3>
                        <p class="text-gray-500 mb-6">Kamu belum pernah mengajukan jadwal bimbingan ke mentor manapun.</p>
                        <a href="{{ route('mentee.explore') }}" class="bg-mentify-blue text-white px-6 py-2.5 rounded-xl font-bold hover:bg-blue-700 transition">
                            Cari Mentor Sekarang
                        </a>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>