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
        Schema::create('branches', function (Blueprint $table) {
            $table->id("branch_id");
            $table->string("branch_name");
            $table->string("branch_type");
            $table->string("branch_location");
            $table->timestamp("branch_date_created")->useCurrent();
            // Relationship stockist_level to branch
            $table->unsignedBigInteger("stockist_level")->nullable();
            $table->foreign('stockist_level')->references('stockist_level_id')->on('stockist_levels')->onDelete('cascade');

            $table->boolean("add_member")->default(false);
            $table->boolean("create_slot")->default(false);
            $table->string("custom_code")->nullable();
            $table->boolean("archive")->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
