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
        Schema::table('invoices', function (Blueprint $table) {
            $table->text('terms')->nullable()->after('total'); // Adjust the column position as needed
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
{
    Schema::table('invoices', function (Blueprint $table) {
        $table->dropColumn('terms');
    });
}

};
