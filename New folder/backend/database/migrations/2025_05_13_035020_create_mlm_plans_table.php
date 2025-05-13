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
        Schema::create('mlm_plans', function (Blueprint $table) {
            $table->id('mlm_plan_id');
            $table->string('mlm_plan_code');
            // $table->string('mlm_plan_label');
            // $table->string('mlm_plan_type');
            $table->string('mlm_plan_trigger');
            $table->boolean('mlm_plan_enable')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mlm_plans');
    }
};
