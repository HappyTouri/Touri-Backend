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
                // Modify the hotel_website column from string to text
                $table->text('hotel_website')->nullable()->change();
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
                // Revert the hotel_website column from text to string
                $table->string('hotel_website')->nullable()->change();
            });
        });
    }
};
