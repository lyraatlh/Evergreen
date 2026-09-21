<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('dim_plant', function (Blueprint $table) {
            $table->unsignedBigInteger('Plant_ID')->primary();
            $table->string('Plant_Name', 255);
            $table->unsignedBigInteger('Type_ID');
            $table->decimal('Price', 12, 2);
            $table->unsignedInteger('Stock')->default(0);

            // Kept nullable so existing application code can use latest()
            // without forcing timestamps to be managed by the model.
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->foreign('Type_ID')
                ->references('Type_ID')
                ->on('plant_type')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->index('Type_ID');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dim_plant');
    }
};