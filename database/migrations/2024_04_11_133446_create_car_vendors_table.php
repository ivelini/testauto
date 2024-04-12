<?php

use App\Models\Catalog\CarCountry;
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
        Schema::create('car_vendors', function (Blueprint $table) {
            $table->id();
            $table->comment('Производитель');
            $table->foreignIdFor(CarCountry::class)->constrained()->onDelete('cascade');
            $table->string('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_vendors');
    }
};
