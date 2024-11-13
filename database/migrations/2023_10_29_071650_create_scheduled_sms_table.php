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
        Schema::create('scheduled_sms', function (Blueprint $table) {
            $table->id();
            $table->string('sender_number')->nullable();
            $table->string('receipient')->nullable();
            $table->string('message')->nullable();
            $table->boolean('status')->default(1);
            $table->string('schedule_date')->nullable();
            $table->string('schedule_time')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_sms');
    }
};
