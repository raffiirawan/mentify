<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profil Mentor') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Tombol Kembali --}}
            <a href="{{ route('mentee.explore') }}" class="text-gray-500 hover:text-mentify-blue mb-6 flex items-center gap-2 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Eksplor
            </a>

            {{-- ==========================================
                 HERO SECTION & BIO
                 ========================================== --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8 flex flex-col md:flex-row gap-8 items-start">
                
                {{-- Avatar Besar --}}
                <div class="w-32 h-32 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center flex-shrink-0 text-4xl font-bold text-mentify-blue shadow-inner">
                    {{ substr($mentor->name, 0, 1) }}
                </div>

                {{-- Info Utama --}}
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $mentor->name }}</h1>
                    <p class="text-gray-600 mb-4">{{ $mentor->email }}</p>
                    
                    {{-- Bio (Memanfaatkan kolom bio dari tabel users jika ada) --}}
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 mb-6 text-gray-700 text-sm leading-relaxed">
                        {{ $mentor->bio ?? 'Mentor ini belum menambahkan deskripsi bio.' }}
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="flex flex-wrap gap-4">
                        {{-- Tombol Booking Utama (Sprint 3) --}}
                        <a href="#" class="bg-mentify-blue text-white px-6 py-3 rounded-xl font-bold hover:bg-blue-700 transition shadow-md flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Booking Kelas
                        </a>

                        {{-- Tombol Tanya via WA (Opsi 2) --}}
                        @php
                            // Asumsi ada nomor telepon (fallback ke nomor dummy jika belum ada)
                            $noWa = $mentor->phone_number ?? '628123456789'; 
                            $pesanOtomatis = "Halo Kak {$mentor->name}, saya melihat profil kakak di Mentify. Saya ingin tanya-tanya dulu terkait kelas bimbingannya. Apakah kakak sedang available?";
                        @endphp
                        <a href="https://wa.me/{{ $noWa }}?text={{ urlencode($pesanOtomatis) }}" target="_blank" class="bg-white text-green-600 border-2 border-green-500 px-6 py-3 rounded-xl font-bold hover:bg-green-50 transition flex items-center gap-2">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            Tanya via WA
                        </a>
                    </div>
                    <p class="text-xs text-gray-500 mt-2 italic">*Pastikan kembali ke Mentify untuk booking resmi agar dapat memberikan ulasan.</p>
                </div>
            </div>

            {{-- Grid Bawah: Kelas & Portofolio --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- ==========================================
                     DAFTAR KELAS MENTOR (Kolom Kiri - Lebar)
                     ========================================== --}}
                <div class="lg:col-span-2 space-y-6">
                    <h3 class="text-xl font-bold text-gray-900 border-b pb-2">Kelas yang Tersedia</h3>
                    
                    @forelse($mentor->mentoringClasses as $class)
                        <div class="bg-white border border-gray-100 rounded-xl p-6 shadow-sm flex flex-col sm:flex-row justify-between sm:items-center gap-4 hover:shadow-md transition">
                            <div>
                                <span class="px-3 py-1 bg-blue-50 text-mentify-blue text-xs font-bold rounded-md mb-2 inline-block">
                                    {{ $class->category->name ?? 'Umum' }}
                                </span>
                                {{-- Jika tabel class punya judul/deskripsi, bisa ditaruh di sini --}}
                                <h4 class="font-bold text-lg text-gray-800">Sesi Bimbingan {{ $class->category->name ?? 'Umum' }}</h4>
                            </div>
                            <div class="text-right">
                                <p class="text-sm text-gray-500 mb-1">Harga per sesi</p>
                                <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($class->price_per_hour, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="bg-gray-50 rounded-xl p-8 text-center text-gray-500 border border-dashed border-gray-300">
                            Mentor ini belum membuka kelas apa pun.
                        </div>
                    @endforelse
                </div>

                {{-- ==========================================
                     MINI PORTOFOLIO (Kolom Kanan - Sempit)
                     ========================================== --}}
                <div class="space-y-6">
                    <h3 class="text-xl font-bold text-gray-900 border-b pb-2">Portofolio & Pengalaman</h3>
                    
                    @forelse($mentor->portfolios as $portfolio)
                        <div class="bg-white border border-gray-100 rounded-xl p-5 shadow-sm hover:border-blue-300 transition">
                            <h4 class="font-bold text-gray-900 mb-1">{{ $portfolio->title }}</h4>
                            @if($portfolio->description)
                                <p class="text-sm text-gray-600 mb-3">{{ $portfolio->description }}</p>
                            @endif
                            @if($portfolio->project_url)
                                <a href="{{ $portfolio->project_url }}" target="_blank" class="text-mentify-blue text-sm font-semibold hover:underline flex items-center gap-1">
                                    Lihat Detail
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                </a>
                            @endif
                        </div>
                    @empty
                        <div class="bg-gray-50 rounded-xl p-6 text-center text-sm text-gray-500 border border-dashed border-gray-300">
                            Belum ada portofolio yang ditambahkan.
                        </div>
                    @endforelse
                </div>

            </div>
        </div>
    </div>
</x-app-layout>