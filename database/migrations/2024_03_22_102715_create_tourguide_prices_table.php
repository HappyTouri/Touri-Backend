<?php
use App\Models\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tourguide_prices', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->foreignId('country_id')->constrained('countries');
            $table->timestamps();

            // Add unique constraint to country_id column
            $table->unique('country_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tourguide_prices');
    }
};
