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
            // Dropping boolean columns
            $table->dropColumn(['email_send', 'available', 'confirmed', 'paid', 'email_canceled']);

            // Adding new columns
            $table->string('status')->nullable(); // A new string column for status, can be null
            $table->text('email_note')->nullable(); // A new text column for email note, can be null
            $table->decimal('invoice_price', 10, 2)->nullable(); // A new decimal column for invoice price
            $table->decimal('payment_price', 10, 2)->nullable(); // A new decimal column for payment price
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tour_details', function (Blueprint $table) {
            // Re-adding the boolean columns
            $table->boolean('email_send')->default(false);
            $table->boolean('available')->default(false);
            $table->boolean('confirmed')->default(false);
            $table->boolean('paid')->default(false);
            $table->boolean('email_canceled')->default(false);

            // Dropping the new columns
            $table->dropColumn(['status', 'email_note', 'invoice_price', 'payment_price']);
        });
    }
};
