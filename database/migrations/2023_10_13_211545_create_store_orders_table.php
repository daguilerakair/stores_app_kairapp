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
        Schema::create('store_orders', function (Blueprint $table) {
            $table->id(); // Unique identifier for the store order.
            $table->integer('total'); // Total amount for the store order.
            $table->foreignId('order_id')->constrained('orders'); // Foreign key to the related order.
            $table->foreignId('substore_id')->constrained('sub_stores'); // Foreign key to the related substore.
            $table->timestamps(); // Timestamps for record creation and modification.
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_orders'); // Drop the 'store_orders' table when rolling back the migration.
    }
};
