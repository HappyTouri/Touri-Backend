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
        Schema::table('r_room_categories', function (Blueprint $table) {
            // Drop the existing foreign key constraint if it exists
            $table->dropForeign(['room_category_id']);

            // Add a new foreign key constraint referencing `hotel_room_categories` table
            $table->foreign('room_category_id')
                ->references('id')
                ->on('hotel_room_categories')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('r_room_categories', function (Blueprint $table) {
            // Drop the new foreign key constraint
            $table->dropForeign(['room_category_id']);

            // Restore the original foreign key constraint (if needed)
            $table->foreignId('room_category_id')
                ->constrained('original_table_name')
                ->onUpdate('original_option')
                ->onDelete('original_option');
        });
    }
};
