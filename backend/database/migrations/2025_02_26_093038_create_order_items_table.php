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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id("order_items_id");
            // Relationship order_id to orders
            $table->unsignedBigInteger("order_id");
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            // Relationship item_id to items
            $table->unsignedBigInteger("item_id");
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
            $table->double("order_item_price");
            $table->integer("quantity");
            $table->double("order_item_subtotal");
            $table->string("discount_type");
            $table->double("discount_percentage");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
