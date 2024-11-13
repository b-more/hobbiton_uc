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
        Schema::create('ussd_gateways', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('business_id');
            $table->integer('digits');
            $table->integer('short_code');
            $table->integer('main_short_code');
            $table->string('app_name');
            $table->string('destination_url')->nullable();
            $table->text('app_description')->nullable();
            $table->boolean('is_live')->default(0);
            $table->boolean('is_active')->default(0);
            $table->boolean('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ussd_gateways');
    }
};
