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
        Schema::create('scans', function (Blueprint $table) {
            $table->id();
            $table->string('ean');
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('update_data')->default(0);
            $table->unsignedBigInteger('stocktake_user_id')->nullable();
            $table->unsignedBigInteger('stocktake_id')->nullable();
            $table->integer('api');
            $table->string('weight')->nullable();
            $table->integer('full_pack')->default(0)->nullable();
            $table->string('add_full_pack')->nullable();
            $table->string('expire');
            $table->timestamps();

            $table->foreign('stocktake_user_id')
                ->references('id')
                ->on('stocktake_users')
                ->onDelete('cascade');

            $table->foreign('stocktake_id')
                ->references('id')
                ->on('stocktakes')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scans');
    }
};
