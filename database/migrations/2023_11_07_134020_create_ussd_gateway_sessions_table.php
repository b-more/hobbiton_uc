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
        Schema::create('ussd_gateway_sessions', function (Blueprint $table) {
            $table->id();
            $table->string("session_id");
            $table->string("network");
            $table->string("phone_number");
            $table->string("project_status");
            $table->integer("main_short_code");
            $table->integer("short_code");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ussd_gateway_sessions');
    }
};
