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
        Schema::table('pages_slider', function (Blueprint $table) {
            $table->dropColumn([
                'title_en',
                'title_ar',
                'description_en',
                'description_ar',
                'url'
            ]);
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('pages_slider', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->mediumText('description_en')->nullable();
            $table->mediumText('description_ar')->nullable();
            $table->string('url')->nullable();
        });
    }
};
