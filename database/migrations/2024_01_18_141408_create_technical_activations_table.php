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
        Schema::create('technical_activations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('demand_id');
            $table->string('team_id');
            $table->string('start_city');
            $table->string('work_city');
            $table->string('end_city');
            $table->string('start_at');
            $table->string('end_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical_activations');
    }
};
