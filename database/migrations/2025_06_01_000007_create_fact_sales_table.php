<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fact_sales', function (Blueprint $table) {
            $table->id();
            $table->string('Transaction_ID', 100);
            $table->unsignedBigInteger('Customer_ID');
            $table->unsignedBigInteger('Plant_ID');
            $table->unsignedBigInteger('Time_ID')->nullable();
            $table->unsignedBigInteger('Supplier_ID')->nullable();
            $table->unsignedInteger('Quantity')->default(1);
            $table->decimal('Total_Payment', 12, 2);
            $table->timestamps();

            $table->foreign('Customer_ID')
                ->references('Customer_ID')
                ->on('dim_customer')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('Plant_ID')
                ->references('Plant_ID')
                ->on('dim_plant')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table->foreign('Supplier_ID')
                ->references('Supplier_ID')
                ->on('dim_supplier')
                ->onUpdate('cascade')
                ->onDelete('set null');

            $table->index('Transaction_ID');
            $table->index('Time_ID');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fact_sales');
    }
};