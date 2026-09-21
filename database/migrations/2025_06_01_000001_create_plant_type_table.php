<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plant_type', function (Blueprint $table) {
            $table->unsignedBigInteger('Type_ID')->primary();
            $table->string('Type_Name', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plant_type');
    }
};