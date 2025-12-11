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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->longText('data');
            $table->enum('type',['license','product'])->default('license');
            $table->decimal('price',11,2)->default(0);
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->string('invoice_number')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('send_notification')->nullable();
            $table->longText('invoice_data')->nullable();
            $table->longText('pay_url')->nullable();
            $table->integer('pay_order_id')->nullable();
            $table->timestamp('payed')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
