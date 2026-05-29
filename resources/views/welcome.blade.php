<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mentify - Platform Mentoring PENS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-mentify-light">

    <!-- ============================================
         NAVBAR - Clean Design dengan 3 bagian
         ============================================ -->
    <nav class="bg-white shadow-sm border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                
                <!-- ========== BAGIAN KIRI: Logo & Brand ========== -->
                <div class="flex items-center gap-2">
                    <!-- Icon SVG Simpel -->
                    <a href="/">
                        <svg class="w-8 h-8 text-mentify-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </a>
                    <a href="/" class="text-xl font-bold text-mentify-dark">Mentify</a>
                </div>

                <!-- ========== BAGIAN TENGAH: Menu Navigasi ========== -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#kategori" class="text-gray-600 hover:text-mentify-blue font-medium transition-colors">
                        Kategori
                    </a>
                    <a href="#cara-kerja" class="text-gray-600 hover:text-mentify-blue font-medium transition-colors">
                        Cara Kerja
                    </a>
                    <a href="#testimoni" class="text-gray-600 hover:text-mentify-blue font-medium transition-colors">
                        Testimoni
                    </a>
                </div>

                <!-- ========== BAGIAN KANAN: CTA Buttons ========== -->
                <div class="flex items-center gap-4">
                    @guest
                        <a href="{{ route('login') }}" class="text-slate-600 font-semibold hover:text-mentify-blue transition">
                            Masuk
                        </a>
                        <a href="{{ route('register') }}" class="bg-mentify-blue text-white px-5 py-2.5 rounded-lg font-bold hover:bg-blue-700 transition shadow-md">
                            Mulai Sekarang
                        </a>
                    @endguest

                    @auth
                        <a href="{{ route('dashboard') }}" class="bg-mentify-navy text-white px-5 py-2.5 rounded-lg font-bold hover:bg-gray-800 transition shadow-md flex items-center gap-2">
                            <span>Ke Dashboard</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <!-- ============================================
         HERO SECTION - Clean Design
         ============================================ -->
    <section class="min-h-[calc(100vh-5rem)] flex items-center bg-mentify-light">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                
                <!-- ========== KOLOM KIRI: Konten Teks ========== -->
                <div>
                    <!-- Heading Utama -->
                    <h1 class="text-5xl lg:text-6xl font-extrabold text-mentify-dark leading-tight">
                        Mentoring Project & Tugas Langsung dari Mentor Berpengalaman
                    </h1>

                    <!-- Deskripsi -->
                    <p class="text-lg text-slate-600 mt-6 max-w-lg">
                        Tingkatkan skill teknismu dengan bimbingan 1-on-1 dari mahasiswa PENS terbaik. Jadwalkan sesi, bahas tugas akhir, atau mulai project bareng.
                    </p>

                    <!-- CTA Buttons -->
                    <div class="mt-8 flex flex-wrap gap-4">
                        <!-- Button 1: Mulai Sekarang -->
                        <a href="{{ route('register') }}" class="bg-mentify-blue text-white px-8 py-3 rounded-xl font-semibold shadow-lg hover:shadow-xl transition">
                            Mulai Sekarang
                        </a>

                        <!-- Button 2: Lihat Kategori -->
                        <a href="#kategori" class="bg-white text-mentify-dark border border-gray-200 px-8 py-3 rounded-xl font-semibold hover:bg-gray-50 transition">
                            Lihat Kategori
                        </a>
                    </div>
                </div>

                <!-- ========== KOLOM KANAN: Gambar ========== -->
                <div class="relative w-full aspect-[4/3] lg:aspect-square">
                    <img 
                        src="{{ asset('images/hero-student.png') }}" 
                        alt="Mentoring Session" 
                        class="w-full h-full object-cover rounded-3xl shadow-2xl"
                        onerror="this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'800\' height=\'800\' viewBox=\'0 0 800 800\'%3E%3Crect fill=\'%23F8FAFC\' width=\'800\' height=\'800\'/%3E%3Crect x=\'100\' y=\'100\' width=\'600\' height=\'600\' rx=\'40\' fill=\'%23E2E8F0\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' dominant-baseline=\'middle\' text-anchor=\'middle\' font-family=\'system-ui\' font-size=\'32\' font-weight=\'600\' fill=\'%2364748B\'%3EMentoring Session%3C/text%3E%3C/svg%3E'"
                    >
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================
         SECTION KATEGORI - Clean Design
         ============================================ -->
    <section id="kategori" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="text-center mb-16">
                <!-- Sub-judul -->
                <p class="text-mentify-blue font-bold tracking-wider text-sm uppercase">
                    EKSPLORASI SKILL
                </p>
                
                <!-- Judul Utama -->
                <h2 class="text-4xl font-extrabold text-mentify-dark mt-2">
                    Pilih Fokus Belajarmu
                </h2>
                
                <!-- Deskripsi -->
                <p class="text-slate-600 mt-4">
                    Kuasai skill teknis yang paling banyak dicari untuk tugas akhir dan project kampus.
                </p>
            </div>

            <!-- Grid Kategori Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Card 1: Web Development -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                    <!-- Icon -->
                    <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-mentify-blue mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                    </div>
                    
                    <!-- Judul -->
                    <h3 class="text-xl font-bold text-mentify-dark mb-3">
                        Web Development
                    </h3>
                    
                    <!-- Skill List -->
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Laravel, PHP, JavaScript Dasar
                    </p>
                </div>

                <!-- Card 2: Internet & Networking -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                    <!-- Icon -->
                    <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-mentify-blue mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                        </svg>
                    </div>
                    
                    <!-- Judul -->
                    <h3 class="text-xl font-bold text-mentify-dark mb-3">
                        Internet & Networking
                    </h3>
                    
                    <!-- Skill List -->
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Mikrotik, Layer 2 Networking, Security
                    </p>
                </div>

                <!-- Card 3: Computer Vision -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                    <!-- Icon -->
                    <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-mentify-blue mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </div>
                    
                    <!-- Judul -->
                    <h3 class="text-xl font-bold text-mentify-dark mb-3">
                        Computer Vision
                    </h3>
                    
                    <!-- Skill List -->
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Image Segmentation, YOLO, Python
                    </p>
                </div>

                <!-- Card 4: Embedded System & IoT -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                    <!-- Icon -->
                    <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-mentify-blue mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                        </svg>
                    </div>
                    
                    <!-- Judul -->
                    <h3 class="text-xl font-bold text-mentify-dark mb-3">
                        Embedded System & IoT
                    </h3>
                    
                    <!-- Skill List -->
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Arduino, ESP32, Sensor Interfacing
                    </p>
                </div>

                <!-- Card 5: UI/UX Design -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                    <!-- Icon -->
                    <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-mentify-blue mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>
                    </div>
                    
                    <!-- Judul -->
                    <h3 class="text-xl font-bold text-mentify-dark mb-3">
                        UI/UX Design
                    </h3>
                    
                    <!-- Skill List -->
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Figma, Wireframing, Prototyping
                    </p>
                </div>

                <!-- Card 6: Mobile Development -->
                <div class="bg-white rounded-2xl p-8 border border-gray-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 cursor-pointer">
                    <!-- Icon -->
                    <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-mentify-blue mb-6">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    
                    <!-- Judul -->
                    <h3 class="text-xl font-bold text-mentify-dark mb-3">
                        Mobile Development
                    </h3>
                    
                    <!-- Skill List -->
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Flutter, React Native, Android Studio
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- ============================================
         SECTION CARA KERJA - Clean Design
         ============================================ -->
    <section id="cara-kerja" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="text-center mb-16">
                <!-- Sub-judul -->
                <p class="text-mentify-blue font-bold tracking-wider text-sm uppercase">
                    CARA KERJA
                </p>
                
                <!-- Judul Utama -->
                <h2 class="text-4xl font-extrabold text-mentify-dark mt-2">
                    Mulai Belajar dalam 4 Langkah
                </h2>
                
                <!-- Deskripsi -->
                <p class="text-slate-600 mt-4">
                    Proses yang cepat dan mudah untuk langsung terhubung dengan mentor pilihanmu.
                </p>
            </div>

            <!-- Grid 4 Langkah -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                
                <!-- Langkah 1: Buat Akun -->
                <div>
                    <!-- Nomor Langkah -->
                    <p class="text-mentify-amber font-bold text-sm tracking-widest mb-4 text-center lg:text-left">
                        LANGKAH 01
                    </p>
                    
                    <!-- Icon Circle -->
                    <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center text-mentify-blue mb-6 mx-auto lg:mx-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    
                    <!-- Judul -->
                    <h3 class="text-xl font-bold text-mentify-dark mb-3 text-center lg:text-left">
                        Buat Akun
                    </h3>
                    
                    <!-- Deskripsi -->
                    <p class="text-sm text-slate-600 leading-relaxed text-center lg:text-left">
                        Daftar menggunakan email standar dalam hitungan detik. Tanpa ribet.
                    </p>
                </div>

                <!-- Langkah 2: Cari Mentor -->
                <div>
                    <!-- Nomor Langkah -->
                    <p class="text-mentify-amber font-bold text-sm tracking-widest mb-4 text-center lg:text-left">
                        LANGKAH 02
                    </p>
                    
                    <!-- Icon Circle -->
                    <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center text-mentify-blue mb-6 mx-auto lg:mx-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    
                    <!-- Judul -->
                    <h3 class="text-xl font-bold text-mentify-dark mb-3 text-center lg:text-left">
                        Cari Mentor
                    </h3>
                    
                    <!-- Deskripsi -->
                    <p class="text-sm text-slate-600 leading-relaxed text-center lg:text-left">
                        Gunakan fitur pencarian untuk menemukan mentor spesialis di mata kuliah atau skill yang kamu butuhkan.
                    </p>
                </div>

                <!-- Langkah 3: Booking Sesi -->
                <div>
                    <!-- Nomor Langkah -->
                    <p class="text-mentify-amber font-bold text-sm tracking-widest mb-4 text-center lg:text-left">
                        LANGKAH 03
                    </p>
                    
                    <!-- Icon Circle -->
                    <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center text-mentify-blue mb-6 mx-auto lg:mx-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    
                    <!-- Judul -->
                    <h3 class="text-xl font-bold text-mentify-dark mb-3 text-center lg:text-left">
                        Booking Sesi
                    </h3>
                    
                    <!-- Deskripsi -->
                    <p class="text-sm text-slate-600 leading-relaxed text-center lg:text-left">
                        Pilih jadwal bimbingan yang pas dan ajukan permintaan kelas langsung ke mentor.
                    </p>
                </div>

                <!-- Langkah 4: Mulai Diskusi -->
                <div>
                    <!-- Nomor Langkah -->
                    <p class="text-mentify-amber font-bold text-sm tracking-widest mb-4 text-center lg:text-left">
                        LANGKAH 04
                    </p>
                    
                    <!-- Icon Circle -->
                    <div class="w-16 h-16 rounded-full bg-slate-50 flex items-center justify-center text-mentify-blue mb-6 mx-auto lg:mx-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    
                    <!-- Judul -->
                    <h3 class="text-xl font-bold text-mentify-dark mb-3 text-center lg:text-left">
                        Mulai Diskusi
                    </h3>
                    
                    <!-- Deskripsi -->
                    <p class="text-sm text-slate-600 leading-relaxed text-center lg:text-left">
                        Dapatkan persetujuan dan langsung terhubung via WhatsApp untuk mulai belajar.
                    </p>
                </div>

            </div>

        </div>
    </section>

    <!-- ============================================
         SECTION TESTIMONI - Clean Design
         ============================================ -->
    <section id="testimoni" class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Header Section -->
            <div class="text-center mb-16">
                <!-- Sub-judul -->
                <p class="text-mentify-blue font-bold tracking-wider text-sm uppercase">
                    APA KATA MEREKA
                </p>
                
                <!-- Judul Utama -->
                <h2 class="text-4xl font-extrabold text-mentify-dark mt-2">
                    Cerita Sukses Mentee
                </h2>
                
                <!-- Deskripsi -->
                <p class="text-slate-600 mt-4">
                    Pengalaman nyata dari mahasiswa yang terbantu oleh platform ini.
                </p>
            </div>

            <!-- Grid Testimoni Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <!-- Testimoni 1: Dina Nabila -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <!-- Bintang Rating -->
                    <div>
                        <div class="flex gap-1 mb-4">
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>

                        <!-- Kutipan -->
                        <p class="text-slate-600 italic leading-relaxed mb-8">
                            "Awalnya sempet stuck banget ngerjain tugas Laravel. Untung nemu mentor di sini yang sabar jelasin dari error sampai jalan programnya."
                        </p>
                    </div>

                    <!-- Profil -->
                    <div class="flex items-center gap-3">
                        <!-- Inisial Circle -->
                        <div class="w-12 h-12 rounded-full bg-blue-50 text-mentify-blue flex items-center justify-center font-bold text-lg flex-shrink-0">
                            DN
                        </div>
                        
                        <!-- Info -->
                        <div>
                            <p class="font-bold text-mentify-dark">Dina Nabila</p>
                            <p class="text-sm text-slate-500">Teknologi Rekayasa Internet</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 2: Rizky Fauzi -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <!-- Bintang Rating -->
                    <div>
                        <div class="flex gap-1 mb-4">
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>

                        <!-- Kutipan -->
                        <p class="text-slate-600 italic leading-relaxed mb-8">
                            "Ngebantu banget buat nyiapin project lomba! Mentornya bener-bener expert di bidang mikrokontroler dan enak diajak diskusi."
                        </p>
                    </div>

                    <!-- Profil -->
                    <div class="flex items-center gap-3">
                        <!-- Inisial Circle -->
                        <div class="w-12 h-12 rounded-full bg-blue-50 text-mentify-blue flex items-center justify-center font-bold text-lg flex-shrink-0">
                            RF
                        </div>
                        
                        <!-- Info -->
                        <div>
                            <p class="font-bold text-mentify-dark">Rizky Fauzi</p>
                            <p class="text-sm text-slate-500">Teknik Mekatronika</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 3: Ahmad Syauqi -->
                <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <!-- Bintang Rating -->
                    <div>
                        <div class="flex gap-1 mb-4">
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            <svg class="w-5 h-5 text-mentify-amber" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                        </div>

                        <!-- Kutipan -->
                        <p class="text-slate-600 italic leading-relaxed mb-8">
                            "Sistem bookingnya gampang dan praktis. Langsung bisa janjian via WA sama kating. Sangat recommended buat yang lagi pusing tugas akhir."
                        </p>
                    </div>

                    <!-- Profil -->
                    <div class="flex items-center gap-3">
                        <!-- Inisial Circle -->
                        <div class="w-12 h-12 rounded-full bg-blue-50 text-mentify-blue flex items-center justify-center font-bold text-lg flex-shrink-0">
                            AS
                        </div>
                        
                        <!-- Info -->
                        <div>
                            <p class="font-bold text-mentify-dark">Ahmad Syauqi</p>
                            <p class="text-sm text-slate-500">Teknik Elektro Industri</p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ============================================
         SECTION CTA (Pre-Footer) - Clean Design
         ============================================ -->
    <section class="py-20 bg-mentify-blue">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            
            <!-- Judul -->
            <h2 class="text-4xl font-extrabold text-white mb-6">
                Siap untuk tingkatkan skill kamu?
            </h2>

            <!-- Sub-judul -->
            <p class="text-lg text-blue-100 mb-10 max-w-2xl mx-auto">
                Bergabung dengan ratusan mahasiswa PENS lainnya yang sudah belajar lebih cerdas bersama mentor sebaya.
            </p>

            <!-- Tombol CTA -->
            <a href="{{ route('register') }}" class="bg-white text-mentify-blue px-10 py-4 rounded-xl font-bold text-lg hover:bg-gray-50 hover:shadow-xl transition-all hover:-translate-y-1 inline-flex items-center gap-2">
                Daftar Sekarang - Gratis
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                </svg>
            </a>

        </div>
    </section>

    <!-- ============================================
         FOOTER - Clean Design
         ============================================ -->
    <footer class="bg-mentify-navy pt-16 pb-8 border-t border-blue-900/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Grid Atas -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                
                <!-- Kolom 1 & 2: Brand -->
                <div class="md:col-span-2">
                    <!-- Logo -->
                    <div class="flex items-center gap-2 mb-6">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="text-xl font-bold text-white">Mentify</span>
                    </div>

                    <!-- Deskripsi -->
                    <p class="text-gray-400 leading-relaxed max-w-md">
                        Platform mentoring peer-to-peer yang menghubungkan mahasiswa PENS dengan mentor berpengalaman untuk bimbingan project, tugas akhir, dan pengembangan skill teknis.
                    </p>
                </div>

                <!-- Kolom 3: Navigasi -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-6">Menu</h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="#kategori" class="text-gray-400 hover:text-white transition-colors">
                                Kategori
                            </a>
                        </li>
                        <li>
                            <a href="#cara-kerja" class="text-gray-400 hover:text-white transition-colors">
                                Cara Kerja
                            </a>
                        </li>
                        <li>
                            <a href="#testimoni" class="text-gray-400 hover:text-white transition-colors">
                                Testimoni
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors">
                                Daftar Mentor
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Kolom 4: Legal/Kampus -->
                <div>
                    <h3 class="text-white font-bold text-lg mb-6">Mentify</h3>
                    <ul class="space-y-3 text-gray-400">
                        <li>Politeknik Elektronika Negeri Surabaya</li>
                        <li>Surabaya, Indonesia</li>
                    </ul>
                </div>

            </div>

            <!-- Bottom Bar -->
            <div class="border-t border-gray-800 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-gray-400 text-sm">
                    <p>
                        &copy; 2026 Mentify.
                    </p>
                </div>
            </div>

        </div>
    </footer>

</body>
</html>
