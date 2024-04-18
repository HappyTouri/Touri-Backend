<?php

use App\Models\RoomCategory;
use App\Models\TourDetail;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('r_room_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TourDetail::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(RoomCategory::class)->constrained();
            $table->integer('extra_bed');
            $table->decimal('room_price', 10, 2)->nullable();
            $table->decimal('extrabed_price', 10, 2)->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('r_room_categories');
    }
};
