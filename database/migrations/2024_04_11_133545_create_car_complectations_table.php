<?php

use App\Models\Catalog\CarBodyType;
use App\Models\Catalog\CarDrive;
use App\Models\Catalog\CarEngine;
use App\Models\Catalog\CarModel;
use App\Models\Catalog\CarTransmission;
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
        Schema::create('car_complectations', function (Blueprint $table) {
            $table->id();
            $table->comment('Заводская комплектация');

            $table->foreignIdFor(CarModel::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(CarTransmission::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(CarBodyType::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(CarDrive::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(CarEngine::class)->constrained()->onDelete('cascade');

            $table->string('name');
            $table->integer('volume_engine');
            $table->integer('power');
            $table->integer('speed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_complectations');
    }
};
