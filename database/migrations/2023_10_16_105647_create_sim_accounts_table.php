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
        Schema::create('sim_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("service_provider_id")->nullable();
            $table->unsignedBigInteger("sms_account_type_id")->nullable();
            $table->unsignedBigInteger("business_id")->nullable();
            $table->string('alphanumeric_id')->nullable();
            $table->integer('digital_short_code')->nullable();
            $table->string('sim_card_number')->nullable();
            $table->integer('port')->nullable();
            $table->string('gateway_ip')->nullable();
            $table->boolean('is_active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sim_accounts');
    }
};
