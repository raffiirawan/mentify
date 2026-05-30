<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eksplor Mentor') }}
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Grid Layout: Sidebar + Content --}}
            <form action="{{ route('mentee.explore') }}" method="GET" class="grid grid-cols-1 lg:grid-cols-4 gap-8">
                
                {{-- ============================================
                     KOLOM KIRI: SIDEBAR FILTER
                     ============================================ --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 sticky top-8">
                        
                        {{-- Header Filter --}}
                        <h3 class="font-bold text-lg mb-4 text-gray-900">Filter Pencarian</h3>

                        {{-- Section Kategori --}}
                        <div class="mb-6">
                            <p class="text-sm font-semibold text-gray-700 mb-3">Kategori</p>
                            
                            <div class="space-y-2">
                                {{-- Checkbox 1 --}}
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="1" {{ in_array('1', request('categories', [])) ? 'checked' : ''}} class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Web Development</span>
                                </label>

                                {{-- Checkbox 2 --}}
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="2" {{ in_array('2', request('categories', [])) ? 'checked' : ''}} class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Internet & Networking</span>
                                </label>

                                {{-- Checkbox 3 --}}
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="3" {{ in_array('3', request('categories', [])) ? 'checked' : ''}} class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Computer Vision</span>
                                </label>

                                {{-- Checkbox 4 --}}
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="4" {{ in_array('4', request('categories', [])) ? 'checked' : ''}} class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Embedded System & IoT</span>
                                </label>

                                {{-- Checkbox 5 --}}
                                <label class="flex items-center cursor-pointer">
                                    <input type="checkbox" name="categories[]" value="5" {{ in_array('5', request('categories', [])) ? 'checked' : ''}} class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">UI/UX Design</span>
                                </label>
                            </div>
                        </div>

                        {{-- Separator --}}
                        <div class="border-t my-4"></div>

                        {{-- Section Harga --}}
                        <div class="mb-6">
                            <p class="text-sm font-semibold text-gray-700 mb-3">Rentang Harga</p>
                            
                            <div class="space-y-2">
                                {{-- Radio 1 --}}
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="price" value="all" {{ request('price', 'all') == 'all' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Semua Harga</span>
                                </label>

                                {{-- Radio 2 --}}
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="price" value="low" {{ request('price') == 'low' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Di bawah Rp 30.000</span>
                                </label>

                                {{-- Radio 3 --}}
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="price" value="mid" {{ request('price') == 'mid' ? 'checked' : '' }} class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-700">Rp 30.000 - Rp 50.000</span>
                                </label>
                            </div>
                        </div>

                        {{-- Tombol Terapkan Filter --}}
                        <button class="w-full bg-mentify-blue text-white rounded-lg py-2 mt-6 hover:bg-blue-700 transition font-semibold">
                            Terapkan Filter
                        </button>

                    </div>
                </div>

                {{-- ============================================
                     KOLOM KANAN: PENCARIAN & HASIL
                     ============================================ --}}
                <div class="lg:col-span-3">
                    
                    {{-- Search Bar --}}
                    <div class="relative mb-8">
                        {{-- Icon Kaca Pembesar --}}
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        
                        {{-- Input Search --}}
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Cari spesialisasi, tools, atau nama mentor (misal: Laravel, YOLOv8, Mikrotik)..."
                            class="w-full bg-white rounded-xl shadow-sm border-0 p-4 pl-12 focus:ring-2 focus:ring-mentify-blue text-gray-900 placeholder-gray-400"
                        >
                    </div>

                    {{-- Header Hasil --}}
                    <h2 class="font-bold text-xl text-gray-800 mb-4">Menampilkan Rekomendasi Mentor</h2>

                    {{-- Grid Hasil Kartu Mentor --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @forelse ($mentors as $mentor)
                          {{-- Template Kartu Mentor --}}
                            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition">
                                
                                {{-- Header Kartu: Avatar + Info --}}
                                <div class="flex items-start gap-4 mb-4">
                                    {{-- Avatar Inisial --}}
                                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center flex-shrink-0">
                                        {{ substr($mentor->name, 0, 1) }}
                                    </div>

                                    {{-- Info Mentor --}}
                                    <div class="flex-1">
                                        <h3 class="font-bold text-lg text-gray-900 mb-1">{{ $mentor->name }}</h3>
                                        <p class="text-sm text-gray-600 mb-2">{{ $mentor->email }}</p>
                                        
                                        {{-- Rating --}}
                                        <div class="flex items-center gap-1">
                                            {{-- Bintang 1-5 --}}
                                            @for($i = 0; $i < 5; $i++)
                                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            @endfor
                                            <span class="text-sm text-gray-600 ml-1">(12 Ulasan)</span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Tag Skill --}}
                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach ($mentor->mentoringClasses->unique('category_id') as $class)
                                        <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs rounded-md">
                                            {{ $class->category->name ?? 'SkillUmum' }}
                                        </span>
                                    @endforeach
                                </div>

                                {{-- Harga & Button --}}
                                <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                    <div>
                                        <p class="text-xs text-gray-500 mb-1">Mulai dari</p>
                                        <span class="font-bold text-mentify-blue">
                                            Rp {{ number_format($mentor->mentoringClasses->min('price_per_hour'), 0, ',', '.') }}
                                            <span class="text-sm text-gray-500 font-normal">/ sesi</span>
                                        </span>
                                    </div>

                                    <a href="{{ route('mentee.mentor.detail', $mentor->id) }}" class="text-mentify-blue border border-mentify-blue px-4 py-2 rounded-lg hover:bg-blue-50 transition font-semibold text-sm">
                                        Lihat Profil
                                    </a>
                                </div>
                            </div>

                        @empty
                            <div class="col-span-1 md:col-span-2 bg-gray-50 rounded-xl border border-dashed border-gray-300 p-12 text-center flex flex-col items-center justify-center">
                                <svg class="w-16 h-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Mentor Tidak Ditemukan</h3>
                                <p class="text-gray-500 text-sm">Coba ubah filter kategori atau sesuaikan rentang harga untuk melihat lebih banyak pilihan.</p>
                                
                                <a href="{{ route('mentee.explore') }}" class="mt-4 px-4 py-2 bg-white border border-gray-300 rounded-lg text-sm font-semibold text-gray-700 hover:bg-gray-50 transition">
                                    Reset Filter
                                </a>
                            </div>
                            {{-- End Grid Hasil --}}  
                        @endforelse
                    </div>

                </div>
                {{-- End Kolom Kanan --}}

            </form>
            {{-- End Grid Layout --}}

        </div>
    </div>
</x-app-layout>
