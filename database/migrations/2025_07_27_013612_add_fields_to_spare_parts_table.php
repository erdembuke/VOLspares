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
        Schema::table('spareparts', function (Blueprint $table) {
            $table->string('model')->nullable();
            $table->year('year')->nullable();
            $table->string('category')->nullable();
            $table->string('part_brand')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('spareparts', function (Blueprint $table) {
            $table->dropColumn(['model', 'year', 'category', 'part_brand']);
        });
    }
};
