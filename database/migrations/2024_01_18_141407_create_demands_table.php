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
        Schema::create('demands', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuidMorphs('contract_type_id');
            $table->uuidMorphs('demand_type_id');
            $table->uuidMorphs('service_type_id');
            $table->string('designation');
            $table->string('city_id');
            $table->uuidMorphs('base_id');
            $table->dateTime('sinos_activation_at');
            $table->dateTime('opened_at');
            $table->uuidMorphs('created_by');
            $table->dateTime('closed_at')->nullable();
            $table->string('closed_by')->nullable();
            $table->string('observation')->nullable();
            $table->string('justification_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demands');
    }
};
