# 🚀 Sprint 2: Setup Data Dummy untuk Fitur Pencarian Mentee

## 📋 Ringkasan
Sprint 2 telah berhasil dibuat dengan lengkap! Berikut adalah struktur database dan data dummy yang telah disiapkan untuk fitur pencarian mentee.

---

## 🗄️ Struktur Database

### 1. **Table: `categories`**
Master data kategori untuk mengklasifikasikan kelas mentoring.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | bigint (PK) | Primary key |
| `name` | string | Nama kategori |
| `slug` | string (unique) | URL-friendly identifier |
| `icon` | string (nullable) | Nama icon untuk UI |
| `created_at` | timestamp | Waktu dibuat |
| `updated_at` | timestamp | Waktu diupdate |

**Relasi:**
- `hasMany` → MentoringClass

---

### 2. **Table: `mentoring_classes`**
Katalog kelas yang ditawarkan oleh mentor.

| Kolom | Tipe | Keterangan |
|-------|------|------------|
| `id` | bigint (PK) | Primary key |
| `mentor_id` | bigint (FK) | Foreign key ke `users.id` |
| `category_id` | bigint (FK) | Foreign key ke `categories.id` |
| `title` | string | Judul kelas |
| `description` | text | Deskripsi lengkap kelas |
| `price_per_hour` | integer | Harga per jam (dalam Rupiah) |
| `is_active` | boolean | Status aktif (default: true) |
| `created_at` | timestamp | Waktu dibuat |
| `updated_at` | timestamp | Waktu diupdate |

**Relasi:**
- `belongsTo` → User (sebagai mentor)
- `belongsTo` → Category

---

## 📊 Data Dummy yang Dibuat

### ✅ Users
- **3 User Awal:**
  - Admin Mentify (admin@student.pens.ac.id)
  - Mentor Networking (mentor@student.pens.ac.id)
  - Mentee Networking (mentee@student.pens.ac.id)

- **5 Mentor Baru (dengan status approved):**
  - Budi Santoso (budi-santoso@student.pens.ac.id)
  - Siti Nurhaliza (siti-nurhaliza@student.pens.ac.id)
  - Ahmad Fauzi (ahmad-fauzi@student.pens.ac.id)
  - Dewi Lestari (dewi-lestari@student.pens.ac.id)
  - Rizky Pratama (rizky-pratama@student.pens.ac.id)

**Password semua user:** `password`

### ✅ Categories (5 Kategori)
1. **Web Development** (slug: `web-development`, icon: `code`)
2. **Internet & Networking** (slug: `internet-networking`, icon: `network`)
3. **Computer Vision** (slug: `computer-vision`, icon: `eye`)
4. **Embedded System & IoT** (slug: `embedded-system-iot`, icon: `cpu`)
5. **UI/UX Design** (slug: `ui-ux-design`, icon: `palette`)

### ✅ Mentoring Classes (14 Kelas)
Setiap mentor memiliki 2-3 kelas dengan kategori random. Contoh kelas:
- Belajar Laravel dari Nol
- Mastering PHP Modern
- Konfigurasi Mikrotik untuk Pemula
- Computer Vision dengan Python
- Arduino untuk IoT
- Desain UI dengan Figma
- Dan lainnya...

**Harga:** Random antara Rp 20.000 - Rp 50.000 per jam

---

## 🛠️ Command yang Dijalankan

```bash
# 1. Buat Model Category dengan Migration, Factory, dan Seeder
php artisan make:model Category -mfs

# 2. Buat Model MentoringClass dengan Migration, Factory, dan Seeder
php artisan make:model MentoringClass -mfs

# 3. Jalankan Migration
php artisan migrate

# 4. Refresh Database dan Jalankan Seeder
php artisan migrate:fresh --seed
```

---

## 📁 File yang Dibuat/Dimodifikasi

### Models
- ✅ `app/Models/Category.php`
- ✅ `app/Models/MentoringClass.php`

### Migrations
- ✅ `database/migrations/2026_05_26_034924_create_categories_table.php`
- ✅ `database/migrations/2026_05_26_034934_create_mentoring_classes_table.php`

### Factories
- ✅ `database/factories/CategoryFactory.php`
- ✅ `database/factories/MentoringClassFactory.php`

### Seeders
- ✅ `database/seeders/DatabaseSeeder.php` (updated)

---

## 🔍 Cara Menggunakan Data Dummy

### Query Eloquent untuk Fitur Pencarian

```php
// 1. Ambil semua kategori
$categories = Category::all();

// 2. Ambil semua kelas mentoring yang aktif
$classes = MentoringClass::where('is_active', true)->get();

// 3. Ambil kelas berdasarkan kategori
$webDevClasses = MentoringClass::whereHas('category', function($query) {
    $query->where('slug', 'web-development');
})->get();

// 4. Ambil kelas dengan relasi mentor dan kategori
$classes = MentoringClass::with(['mentor', 'category'])
    ->where('is_active', true)
    ->get();

// 5. Pencarian berdasarkan judul atau deskripsi
$keyword = 'Laravel';
$results = MentoringClass::where('title', 'like', "%{$keyword}%")
    ->orWhere('description', 'like', "%{$keyword}%")
    ->with(['mentor', 'category'])
    ->get();

// 6. Filter berdasarkan harga
$classes = MentoringClass::whereBetween('price_per_hour', [20000, 35000])
    ->get();

// 7. Ambil mentor dengan jumlah kelas yang diajarkan
$mentors = User::where('role', 'mentor')
    ->where('mentor_status', 'approved')
    ->withCount('mentoringClasses')
    ->get();
```

---

## 🎯 Next Steps untuk UI Pencarian

Sekarang Anda bisa membuat:

1. **Halaman Pencarian Mentee** (`/mentee/search` atau `/browse`)
   - Grid/List view untuk menampilkan semua kelas
   - Filter berdasarkan kategori
   - Search bar untuk pencarian keyword
   - Filter harga (range slider)

2. **Halaman Detail Kelas** (`/class/{id}`)
   - Informasi lengkap kelas
   - Profil mentor
   - Tombol booking

3. **Controller untuk Handle Search**
   ```bash
   php artisan make:controller MenteeSearchController
   ```

4. **Routes untuk Pencarian**
   ```php
   Route::middleware(['auth'])->group(function () {
       Route::get('/browse', [MenteeSearchController::class, 'index'])->name('mentee.browse');
       Route::get('/class/{id}', [MenteeSearchController::class, 'show'])->name('class.show');
   });
   ```

---

## ✅ Verifikasi Data

Jalankan command berikut untuk melihat data:

```bash
# Lihat semua kategori
php artisan tinker --execute="App\Models\Category::all()->pluck('name')"

# Lihat semua mentor
php artisan tinker --execute="App\Models\User::where('role', 'mentor')->get(['name', 'email'])"

# Lihat semua kelas dengan mentor dan kategori
php artisan tinker --execute="App\Models\MentoringClass::with(['mentor', 'category'])->get(['title', 'mentor_id', 'category_id', 'price_per_hour'])"
```

---

## 🔄 Reset Database (Jika Diperlukan)

Jika ingin reset dan generate ulang data dummy:

```bash
php artisan migrate:fresh --seed
```

---

**Status:** ✅ **SELESAI**  
**Total Data:**
- 5 Categories
- 6 Mentors (approved)
- 14 Mentoring Classes

Siap untuk development UI Pencarian! 🚀
