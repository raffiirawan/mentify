<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Jadi Mentor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">Formulir Pengajuan Mentor</h3>
                        <p class="text-gray-600">Isi formulir di bawah ini untuk mengajukan diri sebagai mentor di platform Mentify.</p>
                    </div>

                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">Terdapat beberapa kesalahan:</h3>
                                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('mentor.apply.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Bio/Keahlian -->
                        <div>
                            <label for="bio" class="block text-sm font-semibold text-gray-700 mb-2">
                                Bio / Keahlian <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                id="bio" 
                                name="bio" 
                                rows="6" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="Ceritakan tentang keahlian dan pengalaman Anda di bidang teknologi. Minimal 10 karakter."
                                required
                            >{{ old('bio') }}</textarea>
                            <p class="mt-2 text-sm text-gray-500">
                                Contoh: "Saya mahasiswa Teknik Informatika semester 6 dengan pengalaman 2 tahun di bidang web development. Menguasai Laravel, Vue.js, dan MySQL..."
                            </p>
                        </div>

                        <!-- Portfolio Link -->
                        <div>
                            <label for="portfolio_link" class="block text-sm font-semibold text-gray-700 mb-2">
                                Link Portofolio (LinkedIn/GitHub) <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="url" 
                                id="portfolio_link" 
                                name="portfolio_link" 
                                value="{{ old('portfolio_link') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition"
                                placeholder="https://github.com/username atau https://linkedin.com/in/username"
                                required
                            />
                            <p class="mt-2 text-sm text-gray-500">
                                Masukkan link profil LinkedIn atau GitHub Anda untuk verifikasi keahlian.
                            </p>
                        </div>

                        <!-- Info Box -->
                        <div class="bg-blue-50 border-l-4 border-blue-500 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-blue-700">
                                        <strong>Catatan:</strong> Pengajuan Anda akan direview oleh admin. Pastikan informasi yang Anda berikan akurat dan lengkap.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex gap-4 pt-4">
                            <button 
                                type="submit" 
                                class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition shadow-md hover:shadow-lg"
                            >
                                Kirim Pengajuan
                            </button>
                            <a 
                                href="{{ route('dashboard') }}" 
                                class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-lg transition text-center"
                            >
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
