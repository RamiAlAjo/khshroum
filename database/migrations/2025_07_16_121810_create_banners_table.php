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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->enum('position', ['top', 'middle', 'bottom'])->unique();
            $table->text('description_en')->nullable();
            $table->text('description_ar')->nullable();
            $table->string('button_label_en')->nullable();
            $table->string('button_label_ar')->nullable();
            $table->string('url')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active'); // Service status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
    }
};
