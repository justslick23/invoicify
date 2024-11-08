<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->text('description')->nullable()->after('total'); // Adjust the position as needed
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('invoice_items', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
    
};
