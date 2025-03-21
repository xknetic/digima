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
        Schema::create('slots', function (Blueprint $table) {
                $table->id("slot_id");
                $table->string("slot_username");
                $table->unsignedBigInteger("slot_user_id"); //Connected to users
                $table->unsignedBigInteger("slot_membership_id")->nullable();
                $table->integer("slot_placement")->nullable();
                $table->string("slot_position")->nullable();
                $table->integer("slot_sponsor")->nullable(); // Sponsor Username
                $table->string("slot_type")->nullable();
                $table->double("slot_left_points")->default(0);
                $table->double("slot_right_points")->default(0);
                $table->double("slot_wallet")->default(0);
                $table->double("slot_indirect_wallet_points")->default(0);
                $table->double("slot_total_earnings")->default(0);
                $table->double("slot_total_payout")->default(0);
                $table->integer("slot_stairstep_rank")->nullable();
                $table->string("slot_pairs_per_day_date")->nullable();
                $table->integer("slot_pairs_per_day")->nullable();
                $table->double("slot_personal_spv")->default(0);
                $table->double("slot_group_spv")->default(0);
                $table->integer("slot_used_code")->nullable();
                $table->dateTime("slot_date_created")->nullable();
                $table->tinyInteger("distributed")->nullable();
                $table->dateTime("slot_placement_date")->nullable();
                $table->string("membership_inactive")->nullable();
                $table->string("slot_status")->nullable();
                $table->string("slot_override_points")->nullable(); //
                $table->string("slot_cashback_points")->nullable(); //
                // $table->string("meridiem")->nullable(); //
                $table->integer("current_board_level")->nullable(); //
                $table->string("from_bundle")->nullable();
                $table->string("is_retailer")->nullable();
                $table->string("maintained_until_date")->nullable();
                $table->string("slot_upgrade_points")->nullable();
                $table->string("bonus_no")->nullable();
                $table->string("intial_payout")->nullable();
                $table->string("global_pool_entitled")->nullable();
                $table->string("top_earner_status")->nullable();
                $table->string("slot_count_id")->nullable();
                $table->string("store_name")->nullable();
                $table->string("slot_achievers_rank")->nullable();
                $table->string("welcome_bonus_notif")->nullable();
                $table->string("matrix_sponsor")->nullable();
                $table->string("matrix_position")->nullable();
                $table->string("slot_livewell_rank")->nullable();
                $table->boolean("archive")->default(false);

                $table->foreign('slot_membership_id')->references('membership_id')->on('memberships')->onDelete('cascade');
                $table->foreign('slot_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('slots');
    }
};
