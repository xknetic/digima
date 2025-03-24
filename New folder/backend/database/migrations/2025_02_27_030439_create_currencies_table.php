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
        Schema::create('currencies', function (Blueprint $table) {
            $table->id("currency_id");
            $table->string("currency_name");
            $table->string("currency_abbreviation", 10); // Assuming abbreviations are short (e.g., USD, EUR)
            $table->boolean("currency_buying")->default(false);
            $table->boolean("currency_default")->default(false);
            $table->boolean("currency_enable")->default(false);
            $table->boolean("archive")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('currencies');
    }
};
