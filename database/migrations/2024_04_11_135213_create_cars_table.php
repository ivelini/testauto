<?php

use App\Models\Catalog\CarColor;
use App\Models\Catalog\CarComplectation;
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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->comment('Автомобиль');
            $table->foreignIdFor(CarComplectation::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(CarColor::class)->constrained()->onDelete('cascade');
            $table->integer('year');
            $table->integer('vin');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};