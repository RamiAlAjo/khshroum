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
    Schema::table('products', function (Blueprint $table) {
        $table->unsignedBigInteger('category_id'); // Category reference
        $table->foreign('category_id') // Foreign key constraint
              ->references('id')->on('products_categories') // Correct table name
              ->onDelete('cascade'); // Delete products if the category is deleted
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']); // Drop the foreign key
            $table->dropColumn('category_id'); // Drop the column
        });
    }
};
