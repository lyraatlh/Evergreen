<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dim_customer', function (Blueprint $table) {
            $table->unsignedBigInteger('Customer_ID')->primary();
            $table->string('Name', 255);
            $table->string('Location', 255)->nullable();
            $table->unsignedInteger('Age')->nullable();
            $table->string('Gender', 50)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dim_customer');
    }
};