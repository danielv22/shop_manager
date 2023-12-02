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
        Schema::table('sales', function (Blueprint $table) {
            $table->integer('type')->after('exchange');
            $table->text('reason')->nullable()->after('type');
            $table->string('client')->after('reason');
            $table->boolean('status')->default(true)->after('client');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('type');
            $table->dropColumn('reason');
            $table->dropColumn('client');
            $table->dropColumn('status');
        });
    }
};
