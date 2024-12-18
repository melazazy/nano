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
        Schema::table('services', function (Blueprint $table) {
            // إضافة عمودين جديدين للعناوين
            $table->string('title_en')->nullable()->after('status'); // عنوان باللغة الإنجليزية
            $table->string('title_ar')->nullable()->after('title_en'); // عنوان باللغة العربية
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            // إزالة الأعمدة إذا تم التراجع عن الهجرة
            $table->dropColumn('title_en'); // إزالة عمود title_en
            $table->dropColumn('title_ar'); // إزالة عمود title_ar
        });
    }
};
