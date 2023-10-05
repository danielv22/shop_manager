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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('barcode')->nullable();
            $table->foreignId('brand_id')->nullable()->constrained('brands');
            $table->foreignId('measurement_id')->nullable()->constrained('measurements');
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->decimal('purchase_price', 8,2)->default(0);
            $table->decimal('sale_price', 8,2)->default(0);
            $table->decimal('minimum_stock', 8,2)->default(0);
            $table->integer('state')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
