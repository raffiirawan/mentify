<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6 text-gray-900">
        <div class="flex justify-between items-center">
            <div>
                <h3 class="text-2xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}!</h3>
                <p class="text-gray-600">Temukan mentor terbaik untuk meningkatkan skill Anda.</p>
            </div>
            <div>
                @if (auth()->user()->mentor_status === 'pending')
                    <div class="bg-yellow-50 border border-yellow-300 text-yellow-800 px-4 py-2 rounded-lg">
                        <div class="flex items-center">
                            <svg class="h-5 w-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                    clip-rule="evenodd" />
                            </svg>
                            <span class="font-semibold">Pengajuan Mentor diproses Admin</span>
                        </div>
                    </div>
                @elseif(auth()->user()->mentor_status === 'rejected')
                    <a href="{{ route('mentor.apply') }}"
                        class="bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 px-6 rounded-lg transition inline-block">
                        Ajukan Ulang Jadi Mentor
                    </a>
                @else
                    <a href="{{ route('mentor.apply') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition inline-block">
                        Daftar Jadi Mentor
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg hover:shadow-lg transition">
        <div class="p-6">
            <div class="flex items-center justify-center h-32 bg-blue-100 rounded-lg mb-4">
                <svg class="w-16 h-16 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                </svg>
            </div>
            <h4 class="text-xl font-bold text-gray-800 mb-2">Mentor PHP</h4>
            <p class="text-gray-600 mb-4">Belajar PHP dari dasar.</p>
            <button
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition">Cari
                Mentor</button>
        </div>
    </div>

</div>
