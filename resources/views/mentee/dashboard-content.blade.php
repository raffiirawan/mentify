<x-app-layout>
    {{-- Pembungkus Utama Breeze (Ini yang hilang tadi!) --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- ============================================
                 BAGIAN 1: HEADER & QUICK STATS
                 ============================================ --}}
            <div>
                {{-- Header Sapaan --}}
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        Halo, {{ auth()->user()->name }}
                    </h1>
                    <p class="text-lg text-gray-600">
                        Mau belajar apa hari ini?
                    </p>
                </div>

                {{-- Quick Stats Grid --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    {{-- Stat 1: Sesi Aktif --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Sesi Aktif</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $sesiAktif }}</p>
                            </div>
                            <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Stat 2: Menunggu Konfirmasi --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Menunggu Konfirmasi</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $menungguKonfirmasi }}</p>
                            </div>
                            <div class="w-12 h-12 bg-amber-50 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        </div>
                    </div>

                    {{-- Stat 3: Total Jam Belajar --}}
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-medium text-gray-600 mb-1">Total Jam Belajar</p>
                                <p class="text-3xl font-bold text-gray-900">{{ $totalJamBelajar }}</p>
                            </div>
                            <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- ============================================
                 BAGIAN 2: BANNER EKSPLORASI
                 ============================================ --}}
            <div>
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-8 shadow-lg">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="flex-1">
                            <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">Butuh bimbingan untuk project atau tugas kuliah?</h2>
                            <p class="text-blue-100 text-lg">Temukan mentor yang tepat sekarang.</p>
                        </div>
                        <div>
                            <a href="{{ route('mentee.explore') }}" class="inline-block bg-white text-blue-600 font-bold px-8 py-4 rounded-xl hover:bg-blue-50 hover:shadow-xl transition-all hover:-translate-y-1">
                                Mulai Cari Mentor
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ============================================
                 BAGIAN 3: REKOMENDASI MENTOR (GRID CARDS)
                 ============================================ --}}
            <div>
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-gray-900">Rekomendasi Mentor Pilihan</h2>
                    <p class="text-gray-600 mt-1">Mentor terbaik yang siap membantu perjalanan belajarmu</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    
                    @forelse($rekomendasiMentors as $mentor)
                        @php $sampleClass = $mentor->mentoringClasses->first(); @endphp
                        
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow">
                            <div class="p-6">
                                <div class="flex flex-col items-center mb-4">
                                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center mb-3">
                                        <span class="text-2xl font-bold text-blue-700">{{ strtoupper(substr($mentor->name, 0, 2)) }}</span>
                                    </div>
                                    
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $mentor->name }}</h3>
                                    
                                    @if($sampleClass && $sampleClass->category)
                                        <span class="inline-block bg-blue-50 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full text-center">
                                            {{ $sampleClass->category->name }}
                                        </span>
                                    @endif
                                </div>

                                <div class="mb-4 text-center h-20">
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                        {{ $mentor->bio ?? 'Mentor profesional dan berpengalaman. Siap membantu permasalahan belajarmu.' }}
                                    </p>
                                    
                                    @if($sampleClass)
                                        <div class="flex items-center justify-center gap-2">
                                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            <span class="text-lg font-bold text-gray-900">Rp {{ number_format($sampleClass->price_per_hour, 0, ',', '.') }}</span>
                                            <span class="text-sm text-gray-500">/ sesi</span>
                                        </div>
                                    @else
                                        <span class="text-sm font-semibold text-gray-500 italic">Belum ada kelas aktif</span>
                                    @endif
                                </div>

                                <a href="{{ route('mentee.mentor.detail', $mentor->id) }}" class="block w-full text-center bg-blue-50 text-blue-700 font-semibold py-3 rounded-lg hover:bg-blue-100 transition-colors">
                                    Lihat Profil
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-3 bg-gray-50 p-8 rounded-xl border border-dashed border-gray-300 text-center text-gray-500">
                            Belum ada mentor yang tersedia saat ini.
                        </div>
                    @endforelse

                </div>
            </div>

        </div> {{-- Penutup pembatas lebar --}}
    </div> {{-- Penutup padding Y --}}
</x-app-layout>