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
        Schema::table('tour_details', function (Blueprint $table) {
            // Drop the existing foreign key constraint on `accommodation_id`
            $table->dropForeign(['accommodation_id']);

            // Modify the `accommodation_id` column to make it nullable
            $table->unsignedBigInteger('accommodation_id')->nullable()->change();

            // Add a new foreign key constraint referencing the `accommodations` table
            $table->foreign('accommodation_id')
                ->references('id')
                ->on('accommodations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_details', function (Blueprint $table) {
            // Drop the new foreign key constraint on `accommodation_id`
            $table->dropForeign(['accommodation_id']);

            // Revert the `accommodation_id` column to its original state (not nullable)
            $table->unsignedBigInteger('accommodation_id')->change();

            // Restore the original foreign key constraint (if necessary)
            // Adjust the options as needed for your use case
        });
    }
};
