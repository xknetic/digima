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
        Schema::create('claimed_reward_items', function (Blueprint $table) {
            $table->id("id");
            // Relationship slot_id to items
            $table->unsignedBigInteger("slot_id");
            $table->foreign('slot_id')->references('slot_id')->on('slots')->onDelete('cascade');
            // Relationship reward_item to items
            $table->unsignedBigInteger("reward_item");
            $table->foreign('reward_item')->references('reward_item_id')->on('reward_items')->onDelete('cascade');
            $table->string("status");
            $table->timestamp("claimed_at")->nullable();
            $table->timestamp("approved_at")->nullable();
            $table->timestamp("cancelled_at")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claimed_reward_items');
    }
};
