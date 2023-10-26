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
            $table->integer('stock');
            $table->foreignId('sub_store_id')->constrained('sub_stores');
            $table->foreignId('store_product_id')->constrained('store_products');
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
