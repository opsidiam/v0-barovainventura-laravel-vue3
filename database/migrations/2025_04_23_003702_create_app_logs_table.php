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
        Schema::create('app_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('method', 10);
            $table->string('path');
            $table->text('request')->nullable();
            $table->integer('status');
            $table->string('type')->default('web');
            $table->boolean('success');
            $table->string('ip');
            $table->string('user_agent')->nullable();
            $table->text('error')->nullable();
            $table->text('error_trace')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_logs');
    }
};
