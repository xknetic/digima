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
        Schema::create('cash_in_lists', function (Blueprint $table) {
            $table->id("cash_in_proof_id");
            // Relationship slot_id to slots to get slot_id
            // $table->string("cash_in_slot_code");
            $table->unsignedBigInteger("slot_id");
            $table->foreign('slot_id')->references('slot_id')->on('slots')->onDelete('cascade');
            // Relationship cash_in_member_name to users
            // $table->string("cash_in_member_name");
            $table->unsignedBigInteger("cash_in_member_name");
            $table->foreign('cash_in_member_name')->references('id')->on('users')->onDelete('cascade');
            // Relationship cash_in_method_id to cash_in_methods
            $table->unsignedBigInteger("cash_in_method_id");
            $table->foreign('cash_in_method_id')->references('cash_in_method_id')->on('cash_in_methods')->onDelete('cascade');
            $table->string("cash_in_currency");
            $table->double("cash_in_charge");
            $table->double("cash_in_receivable");
            $table->double("cash_in_payable");
            $table->string("cash_in_proof");
            $table->string("cash_in_status");
            $table->timestamp("cash_in_date")->useCurrent();
            $table->string("cash_in_message");
            // Relationship cash_in_wallet to wallets
            $table->unsignedBigInteger("cash_in_wallet");
            $table->foreign('cash_in_wallet')->references('wallet_id')->on('wallets')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_in_lists');
    }
};
