<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Unique identifier for the product.
            $table->string('name'); // Name of the product.
            $table->string('description'); // Description of the product.
            $table->string('pathImage'); // Path to the product's image.
            $table->string('productMobileId')->nullable(); // Identifier for mobile app integration (optional).
            $table->timestamps(); // Timestamps for record creation and modification.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products'); // Drop the 'products' table when rolling back the migration.
    }
};
