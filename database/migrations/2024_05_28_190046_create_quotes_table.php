<?php

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
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('quote_number')->unique();
            $table->unsignedBigInteger('client_id');
            $table->date('due_date'); // Add due_date field

            $table->decimal('subtotal', 15, 2);  // Add subtotal field
            $table->decimal('discount', 15, 2)->default(0);  // Add discount field
            $table->decimal('total', 15, 2);  // Add total field
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotes');
    }
};
