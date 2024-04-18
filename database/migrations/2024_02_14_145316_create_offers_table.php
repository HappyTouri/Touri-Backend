<?php

use App\Models\Country;
use App\Models\TourHeader;
use App\Models\Transportation;
use App\Models\Driver;
use App\Models\TourGuide;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('operator_id')->nullable()->constrained('users');
            $table->foreignIdFor(Country::class)->constrained();
            $table->boolean('website_share')->default(false);
            $table->boolean('reserved')->default(false);

            $table->string('tour_title');
            $table->foreignIdFor(TourHeader::class)->constrained();
            $table->foreignIdFor(Transportation::class)->constrained();

            $table->date('from');
            $table->date('till');
            $table->integer('number_of_days');

            $table->integer('transportation_price');
            $table->integer('tour_guide_price');
            $table->integer('hotels_price');
            $table->integer('profit_price');
            $table->integer('tour_price');

            $table->string('note')->nullable();
            $table->integer('number_of_people')->nullable();
            $table->foreignIdFor(Driver::class)->constrained()->nullable();
            $table->foreignIdFor(TourGuide::class)->constrained()->nullable();
            $table->foreignId('customer_id')->nullable()->constrained('users');
            $table->timestamp('admin_seen_at')->nullable();
            $table->timestamp('operator_seen_at')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
