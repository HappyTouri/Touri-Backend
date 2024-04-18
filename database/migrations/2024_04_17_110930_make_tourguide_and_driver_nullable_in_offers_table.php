<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->foreignId('tour_guide_id')->nullable()->change();
            $table->foreignId('driver_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            $table->foreignId('tourguide_id')->nullable(false)->change();
            $table->foreignId('driver_id')->nullable(false)->change();
        });
    }
};
