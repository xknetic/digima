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
        Schema::create('carts', function (Blueprint $table) {
            $table->id("cart_id");
            $table->double("cart_quantity");
            $table->unsignedBigInteger("item_id");
            $table->foreign('item_id')->references('item_id')->on('items')->onDelete('cascade');
            $table->unsignedBigInteger("slot_id");
            $table->foreign('slot_id')->references('slot_id')->on('slots')->onDelete('cascade');
            // $table->boolean('archived')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
