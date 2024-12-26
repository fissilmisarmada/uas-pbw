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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type'); // tipe kendaraan, contoh: sedan, SUV
            $table->string('license_plate')->unique(); // plat nomor
            $table->integer('year'); // tahun kendaraan
            $table->decimal('price_per_day', 10, 2); // harga sewa per hari
            $table->boolean('is_available')->default(true); // status ketersediaan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
