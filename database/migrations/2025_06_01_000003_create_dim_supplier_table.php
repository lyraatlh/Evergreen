<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dim_supplier', function (Blueprint $table) {
            $table->unsignedBigInteger('Supplier_ID')->primary();
            $table->string('Supplier_Name', 255);
            $table->string('City', 255)->nullable();
            $table->string('Contact', 100)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dim_supplier');
    }
};