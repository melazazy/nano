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
        Schema::table('services', function (Blueprint $table) {
            $table->integer('file_count')->nullable(); // Add file_count column
            $table->json('file_titles')->nullable(); // Add file_titles column
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('file_count'); // Remove file_count column
            $table->dropColumn('file_titles'); // Remove file_titles column
        });
    }
};
