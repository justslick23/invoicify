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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('quote_id')->nullable();
            $table->date('due_date');
            $table->string('status');
            $table->decimal('subtotal', 15, 2);  // Add subtotal field
            $table->decimal('discount', 15, 2)->default(0);  // Add discount field
            $table->decimal('total', 15, 2);  // Add total field // Adding status field
            // Add other fields as needed
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
