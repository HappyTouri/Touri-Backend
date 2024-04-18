<?php

use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('tour_title_EN');
            $table->string('tour_title_AR');
            $table->string('tour_title_RU');
            $table->string('tour_title_local');
            $table->text('tour_description_EN');
            $table->text('tour_description_AR');
            $table->text('tour_description_RU');
            $table->text('tour_description_local');
            $table->string('video_link');
            $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
