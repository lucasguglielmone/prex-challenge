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
        Schema::create('service_interactions', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('service');
            $table->string('request_body');
            $table->string('response_code');
            $table->string('response_body');
            $table->string('ip_address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_interactions');
    }
};
