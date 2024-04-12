<?php

use App\Models\Catalog\Car;
use App\Models\Catalog\RealComplectAttribute;
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
        Schema::create('real_complect_values', function (Blueprint $table) {
            $table->id();
            $table->comment('Значение для аттрибута реальной комплектации');
            $table->foreignIdFor(RealComplectAttribute::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Car::class)->constrained()->onDelete('cascade');
            $table->string('value_text')->nullable();
            $table->integer('value_int')->nullable();
            $table->date('value_date')->nullable();
            $table->boolean('value_boolean')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('real_complect_values');
    }
};
