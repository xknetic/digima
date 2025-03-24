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
        Schema::create('cash_in_methods', function (Blueprint $table) {
            $table->id("cash_in_method_id");
            // Relationship cash_in_method_category to cash_in_method_categories
            $table->unsignedBigInteger("cash_in_method_category");
            $table->foreign('cash_in_method_category')->references('payment_method_id')->on('payment_methods')->onDelete('cascade');
            $table->string("cash_in_method_name");
            $table->string("cash_in_method_thumbnail")->nullable();
            $table->string("crypto_thumbnail")->nullable();
            $table->string("cash_in_method_currency");
            $table->double("cash_in_method_charge_fixed");
            $table->double("cash_in_method_charge_percentage");
            $table->double("cash_in_method_service_charge");
            $table->text("primary_info")->nullable();
            $table->text("secondary_info")->nullable();
            $table->text("optional_info")->nullable();
            $table->double("cash_in_method_minimum_amount");
            $table->boolean("archive")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_in_methods');
    }
};
