<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('Customer_ID'); // Foreign key ke customers
            $table->unsignedBigInteger('Plant_ID'); // Foreign key ke plants
            $table->integer('Quantity');
            $table->decimal('total_price', 10, 2); // harga total, 10 digit total, 2 digit desimal
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('Customer_ID')->references('Customer_ID')->on('dim_customer')->onDelete('cascade');
            $table->foreign('Plant_ID')->references('Plant_ID')->on('dim_plant')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
}