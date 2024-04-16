<?php

use App\Models\Catalog\Color;
use App\Models\Catalog\Complectation;
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
            $table->foreignIdFor(Complectation::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Color::class)->constrained()->onDelete('cascade');
            $table->integer('year');
            $table->string('vin');
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
