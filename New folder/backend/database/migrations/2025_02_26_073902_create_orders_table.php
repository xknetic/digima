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
        Schema::create('orders', function (Blueprint $table) {
            $table->id("order_id");
            // $table->string("items");
            $table->string("delivery_method");
            $table->integer("delivery_charge");
            $table->double("subtotal");
            $table->string("voucher");
            // Relationship user_id to users to get user address if they input multiple address
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->string("buyer_name");
            // $table->text("buyer_address");
            // $table->string("buyer_contact_number");
            // $table->string("buyer_email");

            // Relationship slot_id to slots to get buyer_sponsor_id, buyer_slot_username and buyer_slot_id
            // $table->unsignedBigInteger("buyer_sponsor_id");
            // $table->foreign('buyer_sponsor_id')->references('slot_id')->on('slots')->onDelete('cascade');
            // //
            // $table->unsignedBigInteger("buyer_slot_username");
            // $table->foreign('buyer_slot_username')->references('slot_id')->on('slots')->onDelete('cascade');
            //
            $table->unsignedBigInteger("buyer_slot_id");
            $table->foreign('buyer_slot_id')->references('slot_id')->on('slots')->onDelete('cascade');
            // $table->foreignId("buyer_sponsor_id")->constrained()->nullable();
            // $table->string("buyer_slot_code")->nullable();
            // $table->foreignId("buyer_slot_id")->constrained()->nullable();

            $table->timestamp("order_date_created")->useCurrent();
            $table->double("dragonpay_charged");
            $table->double("grand_total");
            $table->string("retailer");
            $table->string("order_from");

            // Relationship cashier_id which is for roles to users
            $table->unsignedBigInteger("cashier_id");
            $table->foreign('cashier_id')->references('id')->on('users')->onDelete('cascade');
            $table->double("change");
            // $table->double("discount");
            $table->string("order_status");
            $table->timestamp("order_date_delivered")->nullable();
            $table->timestamp("order_date_completed")->nullable();
            $table->double("manager_discount");
            $table->double("tax_amount");
            $table->text("remarks")->nullable();
            $table->timestamp("date_status_changed")->nullable();
            // $table->string("payment_method");
            $table->unsignedBigInteger("payment_method")->nullable();
            $table->foreign('payment_method')->references('payment_method_id')->on('payment_methods')->onDelete('cascade');
            $table->double("payment_tendered");
            $table->string("courier")->nullable();
            $table->double("shipping_fee");
            $table->double("other_discount")->nullable();
            $table->string("for_approval_trans_no")->nullable();
            $table->double("shipping_fee_v2")->nullable();
            $table->double("handling_fee")->nullable();

            // Relationship Receiver_id to get informations
            $table->unsignedBigInteger("receiver_id")->nullable();
            $table->foreign('receiver_id')->references('receiver_id')->on('receiver_infomations')->onDelete('cascade');
            // $table->string("receiver_name");
            // $table->string("receiver_contact");
            // $table->string("receiver_email");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
