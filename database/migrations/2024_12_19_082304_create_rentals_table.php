<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('rentals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
        $table->date('rental_date');
        $table->date('return_date')->nullable();
        $table->decimal('total_price', 10, 2);
        $table->enum('status', ['ongoing', 'completed', 'cancelled'])->default('ongoing');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
