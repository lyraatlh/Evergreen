<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plant_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Plant_ID');
            $table->string('image_url', 2048);
            $table->timestamps();

            $table->foreign('Plant_ID')
                ->references('Plant_ID')
                ->on('dim_plant')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->index('Plant_ID');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('plant_images');
    }
};