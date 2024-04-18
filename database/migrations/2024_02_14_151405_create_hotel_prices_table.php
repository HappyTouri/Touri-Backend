<?php

use App\Models\HotelRoomCategories;
use App\Models\HotelSeason;
use App\Models\RoomCategory;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hotel_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(HotelRoomCategories::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(HotelSeason::class)->constrained()->cascadeOnDelete();
            $table->integer('price');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_prices');
    }
};
