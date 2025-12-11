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
        Schema::create('post_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('parcel_id')->nullable();
            $table->string('sheet_id')->nullable();
            $table->string('status')->nullable();
            $table->string('state')->nullable();
            $table->longText('data')->nullable();
            $table->longText('error')->nullable();
            $table->longText('label_url')->nullable();
            $table->longText('invoice_url')->nullable();
            $table->string('parcel_number')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_packages');
    }
};
