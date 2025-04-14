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
        Schema::create('receiver_infomations', function (Blueprint $table) {
            $table->id("receiver_id");
            $table->string("receiver_first_name");
            $table->string("receiver_last_name");
            $table->string("receiver_contact");
            $table->string("receiver_address");
            $table->string("receiver_barangay");
            $table->string("receiver_city");
            $table->string("receiver_province");
            $table->integer("receiver_postal");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receiver_infomations');
    }
};
