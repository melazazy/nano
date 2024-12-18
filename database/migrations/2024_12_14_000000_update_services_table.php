<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            // Remove the lang column
            $table->dropColumn('lang');

            // Add new columns
            $table->string('en_name')->after('id');
            $table->text('en_description')->after('en_name');
            $table->string('ar_name')->after('en_description');
            $table->text('ar_description')->after('ar_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            // Re-add the lang column
            $table->string('lang')->after('ar_description');

            // Drop new columns
            $table->dropColumn(['en_name', 'en_description', 'ar_name', 'ar_description']);
        });
    }
}
