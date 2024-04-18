<?php

use App\Models\Accommodation;
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
        Schema::create('hotel_seasons', function (Blueprint $table) {
            $table->id();
            $table->date('from');
            $table->date('till');
            $table->integer('extrabed_price');
            $table->foreignIdFor(Accommodation::class)->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hotel_seasons');
    }
};
