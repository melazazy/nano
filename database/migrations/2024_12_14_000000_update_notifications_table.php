<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class UpdateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Add new columns
            $table->string('ar_title')->nullable();
            $table->text('ar_message')->nullable();
            // Rename existing columns
            $table->renameColumn('title', 'en_title');
            $table->renameColumn('message', 'en_message');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            // Reverse the renaming of columns
            $table->renameColumn('en_title', 'title');
            $table->renameColumn('en_message', 'message');
            // Drop the new columns
            $table->dropColumn('ar_title');
            $table->dropColumn('ar_message');
        });
    }
}
