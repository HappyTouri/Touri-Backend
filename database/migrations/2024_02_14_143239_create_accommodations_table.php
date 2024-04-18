<?php

use App\Models\AccommodationType;
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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('rate');
            $table->string('mobile');
            $table->string('address');
            $table->string('email');
            $table->string('price_list_PDF')->nullable();
            $table->integer('share');
            $table->string('note')->nullable();
            $table->string('cover_photo');
            $table->string('video_link');
            $table->foreignIdFor(City::class)->constrained();
            $table->foreignIdFor(AccommodationType::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
