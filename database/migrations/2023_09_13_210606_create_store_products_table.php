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
        Schema::create('store_products', function (Blueprint $table) {
            $table->id();
            $table->integer('price');
            $table->integer('stock');
            $table->boolean('status'); // false = deshabilitado, true = habilitado
            $table->string('storeMobileId')->nullable();
            $table->string('productMobileId')->nullable();
            $table->integer('store_rut');
            $table->foreign('store_rut')->references('rut')->on('stores');
            $table->foreignId('product_id')->constrained('products');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_products');
    }
};
