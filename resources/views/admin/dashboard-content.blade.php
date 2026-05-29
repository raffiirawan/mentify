<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
    <div class="p-6 text-gray-900">
        <h3 class="text-2xl font-bold mb-2">Dashboard Admin</h3>
        <p class="text-gray-600">Kelola sistem dan monitor aktivitas platform mentoring.</p>
    </div>
</div>

@php
    $pendingMentors = \App\Models\User::where('mentor_status', 'pending')->get();
@endphp

@if($pendingMentors->count() > 0)
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
        <div class="p-6">
            <h4 class="text-xl font-bold text-gray-800 mb-4">Pengajuan Mentor Pending</h4>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($pendingMentors as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm font-medium text-gray-900">{{ $user->name }}</div></td>
                                <td class="px-6 py-4 whitespace-nowrap"><div class="text-sm text-gray-600">{{ $user->email }}</div></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <div class="flex gap-2">
                                        <form action="{{ route('admin.mentor.approve', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-1 px-3 rounded-lg transition text-xs">Setujui</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endif

<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6">
        <h4 class="text-xl font-bold text-gray-800 mb-4">Statistik Pengguna</h4>
        <div class="grid grid-cols-3 gap-4 text-center">
            <div class="p-4 bg-purple-50 rounded-lg border border-purple-100">
                <div class="text-purple-600 font-bold text-2xl">{{ \App\Models\User::where('role', 'admin')->count() }}</div>
                <div class="text-sm text-gray-600">Admin</div>
            </div>
            <div class="p-4 bg-blue-50 rounded-lg border border-blue-100">
                <div class="text-blue-600 font-bold text-2xl">{{ \App\Models\User::where('role', 'mentor')->count() }}</div>
                <div class="text-sm text-gray-600">Mentor</div>
            </div>
            <div class="p-4 bg-green-50 rounded-lg border border-green-100">
                <div class="text-green-600 font-bold text-2xl">{{ \App\Models\User::where('role', 'mentee')->count() }}</div>
                <div class="text-sm text-gray-600">Mentee</div>
            </div>
        </div>
    </div>
</div>