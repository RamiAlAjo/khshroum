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
        Schema::create('services', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name_en'); // English name
            $table->string('name_ar'); // Arabic name
            $table->text('description_en')->nullable(); // English description
            $table->text('description_ar')->nullable(); // Arabic description
            $table->string('image')->nullable(); // Image path or URL
            $table->string('icon')->nullable(); // Icon file path (e.g. icons/my-icon.png)
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active'); // Service status
            $table->string('slug')->unique(); // Unique slug
            $table->timestamps(); // created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
