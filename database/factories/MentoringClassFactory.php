<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\MentoringClass;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<MentoringClass>
 */
class MentoringClassFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Belajar Laravel dari Nol',
            'Mastering PHP Modern',
            'Konfigurasi Mikrotik untuk Pemula',
            'Jaringan Komputer Layer 2',
            'Computer Vision dengan Python',
            'Image Processing YOLO',
            'Arduino untuk IoT',
            'ESP32 dan Sensor',
            'Desain UI dengan Figma',
            'Prototyping Mobile App',
            'React Native Fundamental',
            'Flutter untuk Pemula',
        ];

        return [
            'mentor_id' => User::factory(),
            'category_id' => Category::factory(),
            'title' => fake()->randomElement($titles),
            'description' => fake()->paragraph(3),
            'price_per_hour' => fake()->numberBetween(20000, 50000),
            'is_active' => true,
        ];
    }
}
