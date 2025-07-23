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
        Schema::create('photos_gallery', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('album_id'); // Foreign key to photo_album
            $table->string('album_images')->nullable(); // For storing image path

            $table->timestamps();

            // Set up the foreign key constraint
            $table->foreign('album_id')->references('id')->on('photo_album')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('photos_gallery');
    }
};
