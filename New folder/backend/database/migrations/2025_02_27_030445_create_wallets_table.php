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
        Schema::create('wallets', function (Blueprint $table) {
            $table->id("wallet_id");
            $table->double("wallet_amount");
            // Relationship slot_id to slots
            $table->unsignedBigInteger("slot_id");
            $table->foreign('slot_id')->references('slot_id')->on('slots')->onDelete('cascade');
            // Relationship currency_id to currencies
            $table->unsignedBigInteger("currency_id");
            $table->foreign('currency_id')->references('currency_id')->on('currencies')->onDelete('cascade');
            $table->string("wallet_address");
            // Optional
            // $table->timestamp("date_gc_triggered")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wallets');
    }
};
