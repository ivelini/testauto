<?php

use App\Models\Catalog\Car;
use App\Models\Catalog\CarRealComplectAttribute;
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
        Schema::create('car_real_complect_volumes', function (Blueprint $table) {
            $table->id();
            $table->comment('Значение для аттрибута реальной комплектации');
            $table->foreignIdFor(CarRealComplectAttribute::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Car::class)->constrained()->onDelete('cascade');
            $table->string('volue_text')->nullable();
            $table->integer('volue_int')->nullable();
            $table->date('volue_date')->nullable();
            $table->boolean('volue_boolean')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_real_complect_volumes');
    }
};
