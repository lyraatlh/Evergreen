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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Customer_ID');
            $table->unsignedBigInteger('Plant_ID');
            $table->timestamps();

            $table->foreign('Customer_ID')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('Plant_ID')->references('Plant_ID')->on('dim_plant')->onDelete('cascade');

            $table->unique(['Customer_ID', 'Plant_ID']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};