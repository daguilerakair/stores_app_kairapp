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
        Schema::create('store_products', function (Blueprint $table) {
            $table->id(); // Unique identifier for the store product.
            $table->integer('price'); // Price of the product.
            $table->integer('stock'); // Available stock quantity.
            $table->boolean('status'); // Status: false = disabled, true = enabled.
            $table->boolean('delete'); // Deletion status: false = not deleted, true = deleted.
            $table->string('storeMobileId')->nullable(); // Identifier for mobile app integration.
            $table->string('productMobileId')->nullable(); // Identifier for the product in mobile app.
            $table->foreignId('substore_id')->constrained('sub_stores'); // Foreign key to substore.
            $table->foreignId('product_id')->constrained('products'); // Foreign key to related product.
            $table->timestamps(); // Timestamps for record creation and modification.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_products'); // Drop the 'store_products' table when rolling back the migration.
    }
};
