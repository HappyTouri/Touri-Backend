<?php
use App\Models\Accommodation;
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
        Schema::create('hotel_room_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Accommodation::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(RoomCategory::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_room_categories');
    }
};
