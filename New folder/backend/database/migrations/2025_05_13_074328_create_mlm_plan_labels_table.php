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
        Schema::create('mlm_plan_labels', function (Blueprint $table) {
            $table->id('label_id');
            $table->string('plan_code');
            $table->string('plan_name');
            $table->unsignedBigInteger("mlm_plan_id")->nullable();
            $table->foreign('mlm_plan_id')->references('mlm_plan_id')->on('mlm_plans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mlm_plan_labels');
    }
};
