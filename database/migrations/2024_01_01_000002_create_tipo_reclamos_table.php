<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('tipo_reclamos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('categoria_reclamo_id')->constrained('categoria_reclamos')->onDelete('cascade');
            $table->string('nombre');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('tipo_reclamos');
    }
};
