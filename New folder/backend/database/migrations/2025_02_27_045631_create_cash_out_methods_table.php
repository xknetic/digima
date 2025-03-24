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
        Schema::create('cash_out_methods', function (Blueprint $table) {
            $table->id("cash_out_method_id");
            // Relationship cash_in_method_category to payment_methods
            $table->unsignedBigInteger("cash_out_method_category");
            $table->foreign('cash_out_method_category')->references('payment_method_id')->on('payment_methods')->onDelete('cascade');
            $table->string("cash_out_method_name");
            $table->text("cash_out_proc")->nullable();
            $table->string("cash_out_method_thumbnail")->nullable();
            $table->double("initial_payout");
            $table->double("minimum_payout");
            // Relationship cash_out_method_currency to currencies
            $table->unsignedBigInteger("cash_out_method_currency");
            $table->foreign('cash_out_method_currency')->references('currency_id')->on('currencies')->onDelete('cascade');
            // $table->double("cash_out_method_method_fee");
            $table->double("cash_out_method_service_charge");
            $table->string("cash_out_method_service_charge_type");
            $table->double("cash_out_method_tax");
            $table->string("cash_out_method_tax_type");
            // $table->double("savings_percentage");
            // $table->double("gc_charge");
            // $table->double("product_charge");
            // $table->double("survey_charge");
            $table->double("cash_limit");
            $table->boolean("archive")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_out_methods');
    }
};
