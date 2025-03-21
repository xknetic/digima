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
        Schema::create('cash_out_lists', function (Blueprint $table) {
            $table->id("cash_out_id");
            $table->string("transaction_id");
            // Relationship user_id to users to get user address if they input multiple address
            // $table->string("cash_out_name");
            $table->unsignedBigInteger("user_id");
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // Relationship slot_id to slots to get slot_id
            // $table->string("cash_out_slot_code");
            $table->unsignedBigInteger("slot_id");
            $table->foreign('slot_id')->references('slot_id')->on('slots')->onDelete('cascade');
            // Relationship cash_out_method_id to cash_out_methods
            $table->unsignedBigInteger("cash_out_method_id");
            $table->foreign('cash_out_method_id')->references('cash_out_method_id')->on('cash_out_methods')->onDelete('cascade');
            // Relationship schedule_id to schedules
            // $table->unsignedBigInteger("schedule_id");
            // $table->foreign('schedule_id')->references('schedule_id')->on('schedules')->onDelete('cascade');
            $table->text("cash_out_account_no")->nullable();
            $table->text("cash_out_account_name")->nullable();
            // $table->text("cash_out_optional_info")->nullable(); //Recall to sir vincent
            // $table->string("cash_out_email_address");
            // $table->string("cash_out_contact_number");
            $table->string("cash_out_tin");
            $table->string("cash_out_currency");
            $table->double("cash_out_amount_requested");
            // $table->double("cash_out_method_fee");
            $table->double("cash_out_tax");
            $table->double("cash_out_service_charge");
            $table->double("cash_out_sub_total");
            $table->double("cash_out_total");
            // $table->double("cash_out_original_amount_deducted");
            $table->text("cash_out_method_message")->nullable();
            $table->string("cash_out_status")->default("pending");
            $table->dateTime("cash_out_date");
            $table->double("cash_out_savings");
            // $table->text("cash_out_remarks")->nullable();
            $table->string("cash_out_type");
            // $table->double("gc_charge");
            // $table->double("product_charge");
            // $table->double("survey_charge");
            // $table->double("cash_limit");
            $table->string("sender_name");
            $table->string("control_number");
            $table->string("receipt_thumbnail")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_out_lists');
    }
};
