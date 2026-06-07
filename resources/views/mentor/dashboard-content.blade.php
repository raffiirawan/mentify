<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Mentor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            {{-- Notifikasi Sukses --}}
            @if(session('success'))
                <div class="p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl font-medium shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ==========================================
                 BAGIAN 1: HEADER & STATS
                 ========================================== --}}
            <div class="bg-gradient-to-r from-mentify-blue to-indigo-700 rounded-2xl p-8 shadow-lg text-white">
                <h3 class="text-3xl font-bold mb-2">Halo, {{ auth()->user()->name }}! 🚀</h3>
                <p class="text-blue-100 text-lg">Siap membagikan ilmumu hari ini? Berikut adalah ringkasan aktivitas bimbinganmu.</p>
            </div>

            {{-- ==========================================
                 BAGIAN 2: REQUEST BIMBINGAN MASUK (PENDING)
                 ========================================== --}}
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-xl font-bold text-gray-900">Permintaan Masuk (Butuh Respons)</h4>
                </div>

                <div class="space-y-4">
                    {{-- Asumsi variabel $pendingRequests dikirim dari Controller --}}
                    @forelse($pendingRequests as $booking)
                        <div class="bg-white rounded-2xl shadow-sm border-l-4 border-yellow-400 p-6 flex flex-col md:flex-row gap-6 items-center hover:shadow-md transition">
                            
                            {{-- Info Mentee --}}
                            <div class="flex items-center gap-4 min-w-[200px]">
                                <div class="w-12 h-12 rounded-full bg-yellow-50 text-yellow-700 font-bold flex items-center justify-center text-lg">
                                    {{ strtoupper(substr($booking->mentee->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h5 class="font-bold text-gray-900 text-lg">{{ $booking->mentee->name }}</h5>
                                    <p class="text-sm text-gray-500">Mentee</p>
                                </div>
                            </div>

                            {{-- Info Kelas & Jadwal --}}
                            <div class="flex-1 bg-gray-50 rounded-xl p-4 border border-gray-100">
                                <p class="text-sm text-gray-600 mb-1">Topik: <span class="font-bold text-gray-900">{{ $booking->mentoringClass->title ?? 'Kelas Terhapus' }}</span></p>
                                <div class="flex items-center gap-2 text-sm text-gray-700">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->translatedFormat('l, d F Y - H:i') }} WIB
                                </div>
                                @if($booking->notes)
                                    <p class="text-sm text-gray-500 mt-2 italic">"{{ $booking->notes }}"</p>
                                @endif
                            </div>

                            {{-- Tombol Aksi --}}
                            <div class="flex flex-col sm:flex-row gap-2 w-full md:w-auto">
                                <form action="{{ route('mentor.requests.update', $booking->id) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" onclick="return confirm('Terima jadwal ini?')" class="w-full bg-mentify-blue hover:bg-blue-700 text-white font-semibold py-2.5 px-6 rounded-xl transition shadow-sm">
                                        Terima
                                    </button>
                                </form>
                                <form action="{{ route('mentor.requests.update', $booking->id) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" onclick="return confirm('Tolak permintaan ini?')" class="w-full bg-red-50 border border-red-100 text-red-700 hover:bg-red-100 font-semibold py-2.5 px-6 rounded-xl transition">
                                        Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="bg-white rounded-2xl shadow-sm border border-dashed border-gray-300 p-8 text-center text-gray-500">
                            Belum ada permintaan bimbingan baru saat ini.
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- ==========================================
                 BAGIAN 3: JADWAL MENDATANG (ACCEPTED)
                 ========================================== --}}
            <div>
                <h4 class="text-xl font-bold text-gray-900 mb-4">Jadwal Mendatang</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {{-- Asumsi variabel $upcomingSchedules dikirim dari Controller --}}
                    @forelse($upcomingSchedules as $schedule)
                        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 relative overflow-hidden">
                            <div class="absolute top-0 left-0 w-1 h-full bg-green-500"></div>
                            <div class="mb-4">
                                <span class="inline-block px-3 py-1 text-xs font-bold text-green-800 bg-green-100 rounded-full mb-3">
                                    Disetujui
                                </span>
                                <h5 class="font-bold text-gray-900 text-lg">{{ $schedule->mentoringClass->title }}</h5>
                                <p class="text-sm text-gray-600 mt-1">Mentee: <span class="font-semibold">{{ $schedule->mentee->name }}</span></p>
                            </div>
                            <div class="pt-4 border-t border-gray-50 flex items-center gap-2 text-sm font-medium text-gray-700">
                                <svg class="w-5 h-5 text-mentify-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                {{ \Carbon\Carbon::parse($schedule->booking_date)->translatedFormat('d M Y, H:i') }}
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-gray-50 rounded-xl border border-dashed border-gray-300 p-8 text-center text-gray-500">
                            Tidak ada jadwal bimbingan terdekat.
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</x-app-layout>