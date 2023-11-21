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
        Schema::create('sub_store_products', function (Blueprint $table) {
            $table->id();
            $table->integer('price'); // Price of the product.
            $table->integer('stock'); // Available stock quantity.
            $table->boolean('status'); // Status: false = disabled, true = enabled.
            $table->boolean('delete'); // Deletion status: false = not deleted, true = deleted.
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('sub_store_id')->constrained('sub_stores');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_store_products');
    }
};
