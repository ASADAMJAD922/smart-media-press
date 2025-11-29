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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_id')->nullable();
            $table->string('fingerprint_id')->nullable();
            $table->string('app_version')->nullable();
            $table->string('device_os')->nullable();
            $table->string('device_os_version')->nullable();
            $table->string('device_type')->nullable();
            $table->string('device_name')->nullable();
            $table->string('device_manufacturer')->nullable();
            $table->integer('device_width')->nullable();
            $table->integer('device_height')->nullable();
            $table->boolean('is_mobile')->default(false);
            $table->string('device_token')->nullable();
            $table->ipAddress('last_ip_address')->nullable();
            $table->timestamp('last_activity_at')->nullable();
            $table->longText('user_agent')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
