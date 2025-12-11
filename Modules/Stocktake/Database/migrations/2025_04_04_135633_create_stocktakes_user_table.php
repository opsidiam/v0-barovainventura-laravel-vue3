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
        Schema::create('stocktake_users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('permissions')->nullable();
            $table->string('password')->nullable();
            $table->string('token')->nullable();
            $table->string('api');
            $table->unsignedBigInteger('bar_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('stocktake_id')->nullable();
            $table->tinyInteger('mine')->default(0);
            $table->timestamps();

            $table->foreign('bar_id')
                ->references('id')
                ->on('bars')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocktake_user');
    }
};
