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
        Schema::create('stocktakes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bar_id')->nullable();
            $table->unsignedBigInteger('mine_user')->nullable();
            $table->string('users')->nullable();
            $table->string('api');
            $table->string('api_key')->nullable();
            $table->string('password');
            $table->tinyInteger('open')->default(1);
            $table->timestamp('expire')->nullable();
            $table->boolean('send_mail')->default(0);
            $table->boolean('ready')->default(0);
            $table->decimal('total_profit',11,2)->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('bar_id')
                ->references('id')
                ->on('bars')
                ->onDelete('cascade');

            $table->foreign('mine_user')
                ->references('id')
                ->on('stocktake_users')
                ->onDelete('cascade');

            $table->index(['user_id', 'bar_id', 'ready']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocktakes');
    }
};
