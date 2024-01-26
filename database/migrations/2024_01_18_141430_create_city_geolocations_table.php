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
        Schema::create('city_geolocations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('city_id');
            $table->double('latitude', 10, 6); // Campo para armazenar a latitude com 10 dígitos, 6 casas decimais
            $table->double('longitude', 10, 6); // Campo para armazenar a longitude com 10 dígitos, 6 casas decimais
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('city_geolocations');
    }
};
