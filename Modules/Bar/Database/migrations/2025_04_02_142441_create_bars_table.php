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
        Schema::create('bars', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('multiple_products')->default(0);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('address');
            $table->string('number');
            $table->string('city');
            $table->string('country');
            $table->string('psc');
            $table->string('chef');
            $table->string('phone');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::table('bars', function (Blueprint $table) {
//            $table->dropForeign(['user_id']);
//        });

        Schema::dropIfExists('bars');
    }
};
