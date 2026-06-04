<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajukan Jadwal Bimbingan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            {{-- Library CSS Flatpickr untuk Kalender Estetik --}}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" type="text/css" href="https://npmcdn.com/flatpickr/dist/themes/airbnb.css">
            
            {{-- Tombol Kembali --}}
            <a href="{{ route('mentee.mentor.detail', $mentor->id) }}" class="text-gray-500 hover:text-mentify-blue mb-6 flex items-center gap-2 transition inline-flex font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Batal & Kembali ke Profil
            </a>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-2xl border border-gray-100 p-8">
                
                {{-- Header Form --}}
                <div class="mb-8 border-b pb-6 flex items-center gap-5">
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center flex-shrink-0 text-2xl font-bold text-mentify-blue shadow-inner">
                        {{ substr($mentor->name, 0, 1) }}
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-900">Booking sesi dengan {{ $mentor->name }}</h3>
                        <p class="text-gray-500 text-sm mt-1">Silakan isi detail spesifikasi bimbingan yang kamu butuhkan di bawah ini.</p>
                    </div>
                </div>

                {{-- Form Utama --}}
                <form action="{{ route('mentee.booking.store', $mentor->id) }}" method="POST" class="space-y-6">
                    @csrf

                    {{-- 1. Pilihan Kelas (Course) --}}
                    <div>
                        <label for="mentoring_class_id" class="block text-sm font-semibold text-gray-700 mb-2">Pilih Topik Kelas <span class="text-red-500">*</span></label>
                        <select name="mentoring_class_id" id="mentoring_class_id" required class="w-full border-gray-300 focus:border-mentify-blue focus:ring-mentify-blue rounded-xl shadow-sm py-3 px-4 text-gray-700 bg-gray-50 focus:bg-white transition">
                            <option value="" disabled {{ old('mentoring_class_id') ? '' : 'selected' }}>-- Pilih spesialisasi yang ingin dipelajari --</option>
                            @foreach($mentor->mentoringClasses as $class)
                                {{-- Asumsi tabel courses punya kolom nama/judul, ubah $course->title jika namamu berbeda --}}
                                <option value="{{ $class->id }}" {{ old('mentoring_class_id') == $class->id ? 'selected' : '' }}>
                                    {{ $class->title }} 
                                </option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 2. Tanggal & Jam Bimbingan --}}
                    <div>
                        <label for="booking_date" class="block text-sm font-semibold text-gray-700 mb-2">Tanggal & Waktu Bimbingan <span class="text-red-500">*</span></label>
                        {{-- Mengatur min date ke H+1 agar mentor punya waktu persiapan --}}
                        <input type="text" name="booking_date" id="booking_date" required 
                            placeholder="Pilih tanggal dan jam..."
                            value="{{ old('booking_date') }}" 
                            class="w-full border-gray-300 focus:border-mentify-blue focus:ring-mentify-blue rounded-xl shadow-sm py-3 px-4 text-gray-700 bg-gray-50 focus:bg-white transition cursor-pointer">
                        <p class="text-xs text-gray-500 mt-2 font-medium">Pilih jadwal minimal 1 hari dari sekarang (H+1).</p>
                        @error('booking_date')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 3. Pesan / Catatan (Notes) --}}
                    <div>
                        <label for="notes" class="block text-sm font-semibold text-gray-700 mb-2">Catatan Tambahan (Opsional)</label>
                        <textarea name="notes" id="notes" rows="4" 
                                  placeholder="Ceritakan singkat apa yang ingin kamu bahas atau kendala yang sedang kamu hadapi..." 
                                  class="w-full border-gray-300 focus:border-mentify-blue focus:ring-mentify-blue rounded-xl shadow-sm py-3 px-4 text-gray-700 bg-gray-50 focus:bg-white transition">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-500 text-xs mt-1 font-medium">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- 4. Tombol Submit --}}
                    <div class="pt-6 mt-8 flex justify-end">
                        <button type="submit" class="bg-mentify-blue text-white px-8 py-3.5 rounded-xl font-bold hover:bg-blue-700 transition shadow-lg hover:shadow-xl w-full sm:w-auto text-center">
                            Kirim Permintaan Bimbingan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{-- Library JS Flatpickr --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Membidik elemen input berdasarkan ID dan menyuntikkan kalender
        flatpickr("#booking_date", {
            enableTime: true,           // Aktifkan pilihan jam
            dateFormat: "Y-m-d H:i",    // Format standar database Laravel
            time_24hr: true,            // Pakai format 24 jam biar gak bingung AM/PM
            minDate: new Date().fp_incr(1), // Batasi minimal besok (H+1)
            disableMobile: "true"       // Memaksa tampilan kalender kustom di HP
        });
    </script>
</x-app-layout>