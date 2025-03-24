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
        Schema::create('memberships', function (Blueprint $table) {
            $table->id("membership_id");
            $table->string("membership_name");
            $table->double("membership_price");
            $table->string("membership_gc")->nullable();
            $table->integer("membership_indirect_level")->nullable();
            $table->integer("membership_binary_level")->nullable();
            $table->integer("membership_unilevel_level")->nullable();
            $table->integer("membership_cashback_level")->nullable();
            $table->integer("membership_leveling_bonus_level")->nullable();
            $table->integer("membership_unilevel_or_level")->nullable();
            $table->integer("membership_product_share_link_level")->nullable();
            $table->integer("membership_overriding_commission_level")->nullable();
            $table->integer("team_sales_bonus_level")->nullable();
            $table->dateTime("membership_date_created")->nullable();
            $table->decimal("membership_required_pv")->nullable();
            $table->decimal("membership_required_pv_or")->nullable();
            $table->boolean("enable_commission")->nullable();
            $table->integer("membership_pairings_per_day")->nullable();
            $table->string("color")->nullable();
            $table->integer("hierarchy")->nullable();
            $table->integer("required_directs")->nullable();
            $table->integer("required_downlines")->nullable();
            $table->decimal("sign_up_bonus")->nullable();
            $table->decimal("sign_up_minimum")->nullable();
            $table->boolean("sign_up_voucher_use")->nullable();
            $table->string("restriction")->nullable();
            $table->integer("mentors_level")->nullable();
            $table->decimal("cashback_percent", 5, 2)->nullable();
            $table->boolean("global_pool_enabled")->nullable();
            $table->string("vortex_registered_token")->nullable();
            $table->decimal("vortex_gc_income")->nullable();
            $table->integer("required_upgrade_points")->nullable();
            $table->integer("given_upgrade_points")->nullable();
            $table->boolean("enable_sponsor_matching")->nullable();
            $table->boolean("can_receive_points")->nullable();
            $table->boolean("flushout_enable")->nullable();
            $table->decimal("global_pool_pv")->nullable();
            $table->decimal("retailer_commission")->nullable();
            $table->decimal("share_link_maximum_income")->nullable();
            $table->integer("share_link_maximum_register_per_day")->nullable();
            $table->decimal("share_link_income_per_registration")->nullable();
            $table->decimal("direct_cashback")->nullable();
            $table->decimal("minimum_move_wallet")->nullable();
            $table->decimal("move_wallet_fee")->nullable();
            $table->boolean("binary_placement_enable")->nullable();
            $table->integer("max_points_per_level")->nullable();
            $table->decimal("max_earnings_per_level")->nullable();
            $table->decimal("max_earnings_per_cycle")->nullable();
            $table->integer("binary_required_direct")->nullable();
            $table->string("matrix_placement")->nullable();
            $table->integer("unilevel_matrix_level")->nullable();
            $table->boolean("archive")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('memberships');
    }
};
