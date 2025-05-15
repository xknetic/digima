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
        Schema::create('membership_direct_incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("membership_id")->nullable();
            $table->foreign('membership_id')->references('membership_id')->on('memberships')->onDelete('cascade');
            $table->unsignedBigInteger("membership_entry_id")->nullable();
            $table->foreign('membership_entry_id')->references('membership_id')->on('memberships')->onDelete('cascade');
            $table->integer('membership_direct_income');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membership_direct_incomes');
    }
};
