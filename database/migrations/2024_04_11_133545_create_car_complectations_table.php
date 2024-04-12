<?php

use App\Models\Catalog\BodyType;
use App\Models\Catalog\Drive;
use App\Models\Catalog\Engine;
use App\Models\Catalog\Mark;
use App\Models\Catalog\Transmission;
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
        Schema::create('complectations', function (Blueprint $table) {
            $table->id();
            $table->comment('Заводская комплектация');

            $table->foreignIdFor(Mark::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Transmission::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(BodyType::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Drive::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Engine::class)->constrained()->onDelete('cascade');

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
        Schema::dropIfExists('complectations');
    }
};
