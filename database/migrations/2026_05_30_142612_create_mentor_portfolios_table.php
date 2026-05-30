<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mentor_portfolios', function (Blueprint $table) {
            $table->id();
            // Kabel penghubung ke tabel users (Mentor)
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            // Kolom isi portofolio
            $table->string('title'); // Nama project atau jabatan (Misal: Web E-Commerce)
            $table->text('description')->nullable(); // Deskripsi project
            $table->string('image_url')->nullable(); // Link gambar
            $table->string('project_url')->nullable(); // Link ke GitHub/Sertifikat (opsional)
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mentor_portfolios');
    }
};
