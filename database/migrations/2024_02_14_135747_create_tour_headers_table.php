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
        Schema::create('tour_headers', function (Blueprint $table) {
            $table->id();
            $table->string('title_EN');
            $table->string('title_AR');
            $table->string('title_RU');
            $table->unsignedInteger('day')->unique(); // Make 'day' field unique and enforce it to be an unsigned integer
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_headers');
    }
};
