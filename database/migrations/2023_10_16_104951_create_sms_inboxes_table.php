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
        Schema::create('sms_inboxes', function (Blueprint $table) {
            $table->id();
            $table->string('sender_number')->nullable();
            $table->string('gateway_ip')->nullable();
            $table->unsignedBigInteger('business_id')->nullable();
            $table->integer('incoming_sms_id')->nullable();
            $table->text('message')->nullable();
            $table->integer('port')->nullable();
            $table->string('smsc')->nullable();
            $table->string('serial_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sms_inboxes');
    }
};
