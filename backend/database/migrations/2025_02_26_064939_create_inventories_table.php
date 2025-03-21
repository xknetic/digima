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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id("inventory_id");
            // Relationship inventory_branch_id to items
            $table->unsignedBigInteger("inventory_branch_id");
            $table->foreign('inventory_branch_id')->references('branch_id')->on('branches')->onDelete('cascade');
            $table->string("inventory_status")->nullable();
            // Realtionship inventory_item_id to items
            $table->unsignedBigInteger("inventory_item_id");
            $table->foreign('inventory_item_id')->references('item_id')->on('items')->onDelete('cascade');

            $table->integer("inventory_quantity");
            $table->integer("inventory_sold");
            $table->double("inventory_total");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
