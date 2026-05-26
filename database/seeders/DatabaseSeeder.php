<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\MentoringClass;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ========================================
        // 1. Create Admin, Mentor, and Mentee Users
        // ========================================
        
        // Create Admin User
        User::create([
            'name' => 'Admin Mentify',
            'email' => 'admin@student.pens.ac.id',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Mentor User
        User::create([
            'name' => 'Mentor Networking',
            'email' => 'mentor@student.pens.ac.id',
            'password' => Hash::make('password'),
            'role' => 'mentor',
        ]);

        // Create Mentee User
        User::create([
            'name' => 'Mentee Networking',
            'email' => 'mentee@student.pens.ac.id',
            'password' => Hash::make('password'),
            'role' => 'mentee',
        ]);

        // ========================================
        // 2. Create 5 Static Categories
        // ========================================
        
        $categories = [
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'icon' => 'code',
            ],
            [
                'name' => 'Internet & Networking',
                'slug' => 'internet-networking',
                'icon' => 'network',
            ],
            [
                'name' => 'Computer Vision',
                'slug' => 'computer-vision',
                'icon' => 'eye',
            ],
            [
                'name' => 'Embedded System & IoT',
                'slug' => 'embedded-system-iot',
                'icon' => 'cpu',
            ],
            [
                'name' => 'UI/UX Design',
                'slug' => 'ui-ux-design',
                'icon' => 'palette',
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // ========================================
        // 3. Create 5 Mentor Users with Approved Status
        // ========================================
        
        $mentorNames = [
            'Budi Santoso',
            'Siti Nurhaliza',
            'Ahmad Fauzi',
            'Dewi Lestari',
            'Rizky Pratama',
        ];

        $mentors = [];
        foreach ($mentorNames as $name) {
            $mentors[] = User::create([
                'name' => $name,
                'email' => Str::slug($name) . '@student.pens.ac.id',
                'password' => Hash::make('password'),
                'role' => 'mentor',
                'mentor_status' => 'approved',
                'bio' => 'Saya adalah mentor berpengalaman di bidang teknologi dengan passion untuk membantu mahasiswa PENS berkembang.',
                'portfolio_link' => 'https://github.com/' . Str::slug($name),
            ]);
        }

        // ========================================
        // 4. Create 2-3 MentoringClass for Each Mentor
        // ========================================
        
        $allCategories = Category::all();
        
        $classTemplates = [
            'Web Development' => [
                ['title' => 'Belajar Laravel dari Nol', 'description' => 'Pelajari framework Laravel mulai dari instalasi, routing, controller, hingga deployment. Cocok untuk pemula yang ingin menguasai web development modern.'],
                ['title' => 'Mastering PHP Modern', 'description' => 'Tingkatkan skill PHP kamu dengan mempelajari OOP, namespace, composer, dan best practices dalam pengembangan aplikasi web profesional.'],
                ['title' => 'RESTful API dengan Laravel', 'description' => 'Buat API yang scalable dan secure menggunakan Laravel. Pelajari authentication, validation, dan dokumentasi API.'],
            ],
            'Internet & Networking' => [
                ['title' => 'Konfigurasi Mikrotik untuk Pemula', 'description' => 'Pelajari dasar-dasar konfigurasi router Mikrotik, mulai dari setting IP, firewall, hingga bandwidth management untuk jaringan kampus.'],
                ['title' => 'Jaringan Komputer Layer 2', 'description' => 'Memahami konsep switching, VLAN, STP, dan troubleshooting jaringan layer 2 dengan studi kasus nyata.'],
                ['title' => 'Network Security Fundamental', 'description' => 'Pelajari konsep keamanan jaringan, firewall rules, VPN, dan cara mengamankan infrastruktur jaringan dari serangan.'],
            ],
            'Computer Vision' => [
                ['title' => 'Computer Vision dengan Python', 'description' => 'Mulai dari dasar image processing menggunakan OpenCV, hingga implementasi algoritma deteksi objek untuk project tugas akhir.'],
                ['title' => 'Image Processing YOLO', 'description' => 'Implementasi YOLO (You Only Look Once) untuk real-time object detection. Cocok untuk project IoT dan sistem monitoring.'],
                ['title' => 'Deep Learning untuk Computer Vision', 'description' => 'Pelajari CNN, transfer learning, dan training model untuk klasifikasi gambar menggunakan TensorFlow dan Keras.'],
            ],
            'Embedded System & IoT' => [
                ['title' => 'Arduino untuk IoT', 'description' => 'Belajar pemrograman Arduino dari dasar, interfacing sensor, dan membuat project IoT sederhana untuk tugas akhir.'],
                ['title' => 'ESP32 dan Sensor Interfacing', 'description' => 'Kuasai ESP32 untuk project IoT dengan WiFi dan Bluetooth. Pelajari cara menghubungkan berbagai sensor dan aktuator.'],
                ['title' => 'IoT dengan MQTT Protocol', 'description' => 'Implementasi protokol MQTT untuk komunikasi IoT, integrasi dengan cloud platform, dan monitoring real-time.'],
            ],
            'UI/UX Design' => [
                ['title' => 'Desain UI dengan Figma', 'description' => 'Pelajari tools Figma dari dasar, membuat wireframe, mockup, hingga prototype interaktif untuk aplikasi mobile dan web.'],
                ['title' => 'Prototyping Mobile App', 'description' => 'Buat prototype aplikasi mobile yang interaktif dan user-friendly. Pelajari prinsip UX design dan usability testing.'],
                ['title' => 'Design System & Component Library', 'description' => 'Membangun design system yang konsisten untuk project besar. Pelajari atomic design dan component-based design.'],
            ],
        ];

        foreach ($mentors as $mentor) {
            // Setiap mentor akan mengajar 2-3 kelas secara random
            $numberOfClasses = rand(2, 3);
            
            // Pilih kategori random untuk mentor ini
            $randomCategories = $allCategories->random($numberOfClasses);
            
            foreach ($randomCategories as $category) {
                // Ambil template kelas berdasarkan kategori
                $templates = $classTemplates[$category->name] ?? [];
                
                if (!empty($templates)) {
                    $template = $templates[array_rand($templates)];
                    
                    MentoringClass::create([
                        'mentor_id' => $mentor->id,
                        'category_id' => $category->id,
                        'title' => $template['title'],
                        'description' => $template['description'],
                        'price_per_hour' => rand(20, 50) * 1000, // 20000 - 50000
                        'is_active' => true,
                    ]);
                }
            }
        }

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📊 Created: 3 initial users + 5 mentors');
        $this->command->info('📁 Created: 5 categories');
        $this->command->info('📚 Created: ' . MentoringClass::count() . ' mentoring classes');
    }
}
