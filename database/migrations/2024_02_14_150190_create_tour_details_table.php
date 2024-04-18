<?php

use App\Models\Accommodation;
use App\Models\Offer;
use App\Models\Tour;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tour_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Offer::class)->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->foreignIdFor(Tour::class)->constrained();
            $table->integer('tourguide');
            $table->foreignIdFor(Accommodation::class)->constrained()->nullable();
            $table->decimal('accommodation_price', 10, 2)->nullable();
            $table->integer('number_of_room');


            $table->boolean('email_send')->default(false);
            $table->boolean('available')->default(false);
            $table->boolean('confirmed')->default(false);
            $table->boolean('paid')->default(false);
            $table->boolean('email_canceled')->default(false);

            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_details');
    }
};
