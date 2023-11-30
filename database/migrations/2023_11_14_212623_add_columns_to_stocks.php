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
        Schema::table('stocks', function (Blueprint $table) {
            $table->string('type')->nullable();
            $table->decimal('purchase_price',8,2)->default(0);
            $table->decimal('sale_price',8,2)->default(0);
            $table->string('reason')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('purchase_price');
            $table->dropColumn('sale_price');
            $table->dropColumn('reason');
        });
    }
};
