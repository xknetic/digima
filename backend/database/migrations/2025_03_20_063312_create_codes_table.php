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
        Schema::create('codes', function (Blueprint $table) {
            $table->id("code_id");
            // Realtionship item_category to product_categories
            $table->unsignedBigInteger("code_inventory_id")->nullable();
            $table->foreign('code_inventory_id')->references('inventory_id')->on('inventories')->onDelete('cascade');
            $table->string("code_activation");
            $table->integer("code_pin");
            $table->integer("code_use")->nullable();
            $table->integer("code_sold")->nullable();
            $table->integer("code_sold_to")->nullable();
            $table->integer("org_code_sold_to")->nullable();
            $table->integer("code_slot_used")->nullable();
            $table->integer("code_date_sold")->nullable();
            $table->integer("code_date_used")->nullable();
            $table->integer("code_used_by")->nullable();
            $table->boolean("archive")->default(false);
            // $table->integer("kit_requirement")->nullable();
            // $table->integer("date_packed")->nullable();
            // $table->integer("dragonpay")->nullable();
            // $table->integer("order_id")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('codes');
    }
};
