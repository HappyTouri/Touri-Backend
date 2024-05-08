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
        Schema::table('accommodations', function (Blueprint $table) {
            Schema::table('accommodations', function (Blueprint $table) {
                $table->string('hotel_website')->nullable(); // Add the new column
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('accommodations', function (Blueprint $table) {
            Schema::table('accommodations', function (Blueprint $table) {
                $table->dropColumn('hotel_website'); // Remove the new column
            });
        });
    }
};
