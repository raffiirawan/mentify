{{-- ============================================
     BAGIAN 1: HEADER & QUICK STATS
     ============================================ --}}
<div class="mb-8">
    {{-- Header Sapaan --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">
            Halo, {{ auth()->user()->name }} 👋
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
                    <p class="text-3xl font-bold text-gray-900">0</p>
                </div>
                <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Stat 2: Menunggu Konfirmasi --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Menunggu Konfirmasi</p>
                    <p class="text-3xl font-bold text-gray-900">0</p>
                </div>
                <div class="w-12 h-12 bg-amber-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Stat 3: Total Jam Belajar --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Jam Belajar</p>
                    <p class="text-3xl font-bold text-gray-900">0</p>
                </div>
                <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- ============================================
     BAGIAN 2: BANNER EKSPLORASI
     ============================================ --}}
<div class="mb-8">
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl p-8 shadow-lg">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <div class="flex-1">
                <h2 class="text-2xl md:text-3xl font-bold text-white mb-3">
                    Butuh bimbingan untuk project atau tugas kuliah?
                </h2>
                <p class="text-blue-100 text-lg">
                    Temukan mentor yang tepat sekarang.
                </p>
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
    {{-- Section Header --}}
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900">Rekomendasi Mentor Pilihan</h2>
        <p class="text-gray-600 mt-1">Mentor terbaik yang siap membantu perjalanan belajarmu</p>
    </div>

    {{-- Grid Mentor Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        {{-- Card 1: Michael Santoso --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-6">
                {{-- Profile Section --}}
                <div class="flex flex-col items-center mb-4">
                    {{-- Inisial Circle --}}
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center mb-3">
                        <span class="text-2xl font-bold text-blue-700">MS</span>
                    </div>
                    
                    {{-- Nama Mentor --}}
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Michael Santoso</h3>
                    
                    {{-- Badge Kategori --}}
                    <span class="inline-block bg-blue-50 text-blue-700 text-xs font-semibold px-3 py-1 rounded-full">
                        Web Development
                    </span>
                </div>

                {{-- Info Singkat --}}
                <div class="mb-4 text-center">
                    <p class="text-sm text-gray-600 mb-3">
                        Expert di Laravel & PHP Modern. Sudah membimbing 20+ mahasiswa.
                    </p>
                    
                    {{-- Harga --}}
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-lg font-bold text-gray-900">Rp 35.000</span>
                        <span class="text-sm text-gray-500">/ sesi</span>
                    </div>
                </div>

                {{-- Button --}}
                <a href="#" class="block w-full text-center bg-blue-50 text-blue-700 font-semibold py-3 rounded-lg hover:bg-blue-100 transition-colors">
                    Lihat Profil
                </a>
            </div>
        </div>

        {{-- Card 2: Dina Amelia --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-6">
                {{-- Profile Section --}}
                <div class="flex flex-col items-center mb-4">
                    {{-- Inisial Circle --}}
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center mb-3">
                        <span class="text-2xl font-bold text-purple-700">DA</span>
                    </div>
                    
                    {{-- Nama Mentor --}}
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Dina Amelia</h3>
                    
                    {{-- Badge Kategori --}}
                    <span class="inline-block bg-purple-50 text-purple-700 text-xs font-semibold px-3 py-1 rounded-full">
                        Networking
                    </span>
                </div>

                {{-- Info Singkat --}}
                <div class="mb-4 text-center">
                    <p class="text-sm text-gray-600 mb-3">
                        Network Admin specialist
                    </p>
                    
                    {{-- Harga --}}
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-lg font-bold text-gray-900">Rp 42.000</span>
                        <span class="text-sm text-gray-500">/ sesi</span>
                    </div>
                </div>

                {{-- Button --}}
                <a href="#" class="block w-full text-center bg-purple-50 text-purple-700 font-semibold py-3 rounded-lg hover:bg-purple-100 transition-colors">
                    Lihat Profil
                </a>
            </div>
        </div>

        {{-- Card 3: Jacky --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-shadow">
            <div class="p-6">
                {{-- Profile Section --}}
                <div class="flex flex-col items-center mb-4">
                    {{-- Inisial Circle --}}
                    <div class="w-20 h-20 rounded-full bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center mb-3">
                        <span class="text-2xl font-bold text-green-700">JK</span>
                    </div>
                    
                    {{-- Nama Mentor --}}
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Jacky</h3>
                    
                    {{-- Badge Kategori --}}
                    <span class="inline-block bg-green-50 text-green-700 text-xs font-semibold px-3 py-1 rounded-full">
                        Embedded System & IoT
                    </span>
                </div>

                {{-- Info Singkat --}}
                <div class="mb-4 text-center">
                    <p class="text-sm text-gray-600 mb-3">
                        Ahli Arduino & ESP32. Juara lomba IoT tingkat nasional.
                    </p>
                    
                    {{-- Harga --}}
                    <div class="flex items-center justify-center gap-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span class="text-lg font-bold text-gray-900">Rp 38.000</span>
                        <span class="text-sm text-gray-500">/ sesi</span>
                    </div>
                </div>

                {{-- Button --}}
                <a href="#" class="block w-full text-center bg-green-50 text-green-700 font-semibold py-3 rounded-lg hover:bg-green-100 transition-colors">
                    Lihat Profil
                </a>
            </div>
        </div>

    </div>
</div>
