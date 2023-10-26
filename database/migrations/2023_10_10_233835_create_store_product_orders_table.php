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
        Schema::create('store_product_orders', function (Blueprint $table) {
            $table->id(); // Unique identifier for the store product order.
            $table->integer('quantity'); // Quantity of the product in the order.
            $table->integer('price'); // Price of the product in the order.
            $table->foreignId('order_id')->constrained('orders'); // Foreign key to the related order.
            $table->foreignId('store_product_id')->constrained('store_products'); // Foreign key to the related store product.
            $table->timestamps(); // Timestamps for record creation and modification.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_product_orders'); // Drop the 'store_product_orders' table when rolling back the migration.
    }
};
