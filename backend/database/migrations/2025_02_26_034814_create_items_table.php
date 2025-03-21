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
        Schema::create('items', function (Blueprint $table) {
            $table->id("item_id");
            $table->string("item_sku");
            $table->string("item_thumbnail")->nullable();
            $table->text("item_description")->nullable();
            $table->text("item_inclusion_details")->nullable();
            $table->string("item_barcode")->nullable();
            $table->double("item_price");
            $table->double("item_charged");
            $table->integer("qty_charged");
            $table->double("item_gc_price")->nullable();
            $table->string("item_type");
            // Realtionship item_category to product_categories
            $table->unsignedBigInteger("item_category")->nullable();
            $table->foreign('item_category')->references('category_id')->on('product_categories')->onDelete('cascade');
            // Relationship item_sub_categories to product_subcategories
            $table->unsignedBigInteger("item_sub_category")->nullable();
            $table->foreign('item_sub_category')->references('subcategory_id')->on('product_subcategories')->onDelete('cascade');
            $table->string("tag_as")->nullable();
            $table->integer("item_points_incetives")->nullable();
            // Realtionship to membership
            $table->unsignedBigInteger("membership_id")->nullable();
            $table->foreign('membership_id')->references('membership_id')->on('memberships')->onDelete('cascade');
            $table->integer("slot_qty")->nullable();
            $table->boolean("inclusive_gc")->nullable();
            $table->timestamp("item_date_created")->useCurrent();
            $table->boolean("archived")->default(false);

            // Deleted
            // $table->unsignedBigInteger("item_inventory_id");
            // $table->foreign('item_inventory_id')->references('inventory_id')->on('inventories')->onDelete('cascade');

            $table->double("item_pv")->nullable();
            $table->string("item_points_currency")->nullable();
            $table->double("item_binary_pts")->nullable();
            $table->string("code_user")->nullable();
            $table->boolean("upgrade_own")->default(false);
            $table->integer("added_days")->nullable();
            $table->boolean("item_availability")->nullable();
            $table->double("cashback_points")->nullable();
            $table->double("cashback_wallet")->nullable();
            $table->string("item_vortex_token")->nullable();
            $table->boolean("is_kit_upgrade")->default(false);
            $table->integer("bind_membership_id")->nullable();
            // Relationship product_id to inventories
            // $table->string("product_id");
            $table->double("direct_cashback")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
