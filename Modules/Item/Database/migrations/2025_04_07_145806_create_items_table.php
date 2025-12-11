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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bar_id');
            $table->tinyInteger('type')->default(0);
            $table->unsignedBigInteger('cargo_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->string('last_stocktake')->nullable();
            $table->string('product_key_supplier')->nullable();
            $table->integer('weight_last_stocktake')->nullable();
            $table->integer('full_pack_last_stocktake')->nullable();
            $table->integer('weight_count')->nullable();
            $table->integer('full_pack_count')->nullable();
            $table->decimal('price_buy',12,2)->nullable();
            $table->decimal('price_sell',12,2)->nullable();
            $table->string('weight_sell')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('bar_id')
                ->references('id')
                ->on('bars')
                ->onDelete('cascade');

            $table->foreign('cargo_id')
                ->references('id')
                ->on('cargos')
                ->onDelete('cascade');

            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
