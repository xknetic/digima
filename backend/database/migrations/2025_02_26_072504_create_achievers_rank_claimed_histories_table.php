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
        Schema::create('achievers_rank_claimed_histories', function (Blueprint $table) {
            $table->id("achievers_rank_claimed_id");
            $table->unsignedBigInteger("slot_id");
            $table->foreign('slot_id')->references('slot_id')->on('slots')->onDelete('cascade');
            $table->integer("rank_id");
            $table->dateTime("claimed_date");
            $table->dateTime("approved_date")->nullable();
            $table->dateTime("rejected_date")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievers_rank_claimed_histories');
    }
};
