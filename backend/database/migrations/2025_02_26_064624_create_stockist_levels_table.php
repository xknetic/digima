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
        Schema::create('stockist_levels', function (Blueprint $table) {
            $table->id("stockist_level_id");
            $table->double("stockist_level_discount")->default(0);
            $table->string("stockist_level_name");
            $table->timestamp("stockist_level_date_created")->useCurrent();
            $table->boolean("archive")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stockist_levels');
    }
};
