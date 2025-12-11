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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name_supplier');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bar_id');
            $table->string('address')->nullable();
            $table->string('address_number')->nullable();
            $table->string('city')->nullable();
            $table->string('psc')->nullable();
            $table->string('stat')->nullable();
            $table->text('note')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('suppliers');
    }
};
