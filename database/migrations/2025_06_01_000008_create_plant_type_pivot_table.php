<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('Plant_Type', function (Blueprint $table) {
            $table->unsignedBigInteger('Type_ID');
            $table->unsignedBigInteger('Category_ID');

            $table->foreign('Type_ID')
                ->references('Type_ID')
                ->on('plant_type')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('Category_ID')
                ->references('Type_ID')
                ->on('plant_type')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->primary(['Type_ID', 'Category_ID']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('Plant_Type');
    }
};