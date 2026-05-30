<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kelola Kategori
        </h2>
    </x-slot>

<div class="py-12 bg-gray-50">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Kelola Kategori</h1>
                <p class="text-gray-600 mt-2">Tambah, edit, dan hapus kategori skill/mata kuliah</p>
            </div>
            <button onclick="toggleAddForm()" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                ➕ Tambah Kategori
            </button>
        </div>

        <!-- Add/Edit Category Form -->
        <div id="addForm" class="bg-white rounded-lg shadow p-6 mb-8 hidden">
            <h2 class="text-xl font-bold text-gray-900 mb-4">Tambah Kategori Baru</h2>
            <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori *</label>
                        <input type="text" name="name" placeholder="cth: PHP Laravel" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('name') }}">
                        @error('name')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Slug *</label>
                        <input type="text" name="slug" placeholder="cth: php-laravel" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('slug') }}">
                        @error('slug')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Icon (emoji atau icon name)</label>
                        <input type="text" name="icon" placeholder="cth: 🐘 atau laravel" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" value="{{ old('icon') }}">
                        @error('icon')
                            <span class="text-red-600 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit" class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition">
                            ✓ Simpan
                        </button>
                        <button type="button" onclick="toggleAddForm()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                            ✕ Batal
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($categories as $category)
                <div class="bg-white rounded-lg shadow p-6 hover:shadow-lg transition">
                    <div class="flex items-start justify-between mb-4">
                        <div class="text-4xl">{{ $category->icon ?? '📚' }}</div>
                        <div class="flex gap-2">
                            <button onclick="editCategory({{ $category->id }}, '{{ $category->name }}', '{{ $category->slug }}', '{{ $category->icon }}')" class="text-blue-600 hover:text-blue-800">
                                ✏️ Edit
                            </button>
                            <form action="{{ route('admin.categories.delete', $category->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus kategori ini? (jika masih ada kelas, tidak bisa dihapus)')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    🗑️ Hapus
                                </button>
                            </form>
                        </div>
                    </div>

                    <h3 class="text-lg font-bold text-gray-900">{{ $category->name }}</h3>
                    <p class="text-sm text-gray-600 mb-4">{{ $category->slug }}</p>

                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-600">
                            📚 {{ $category->mentoring_classes_count }} kelas
                        </span>
                    </div>
                </div>
            @empty
                <div class="col-span-3">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 text-center">
                        <p class="text-blue-900 font-medium">Belum ada kategori. Mulai dengan menambahkan kategori baru!</p>
                    </div>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $categories->links() }}
        </div>
    </div>
</div>

<!-- Edit Modal (simple inline edit) -->
<div id="editModal" class="hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-md w-full">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Edit Kategori</h2>
        <form id="editForm" method="POST" class="space-y-4">
            @csrf
            @method('PATCH')
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Kategori</label>
                <input type="text" id="editName" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                <input type="text" id="editSlug" name="slug" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                <input type="text" id="editIcon" name="icon" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg transition">
                    ✓ Simpan
                </button>
                <button type="button" onclick="closeEditModal()" class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-50 transition">
                    ✕ Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function toggleAddForm() {
    document.getElementById('addForm').classList.toggle('hidden');
}

function editCategory(id, name, slug, icon) {
    document.getElementById('editName').value = name;
    document.getElementById('editSlug').value = slug;
    document.getElementById('editIcon').value = icon;
    document.getElementById('editForm').action = `/admin/categories/${id}`;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('editModal')?.addEventListener('click', function(e) {
    if(e.target === this) {
        closeEditModal();
    }
});
</script>
</x-app-layout>
