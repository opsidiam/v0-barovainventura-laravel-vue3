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
        Schema::create('cargo_last_states', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('bar_id');
            $table->unsignedBigInteger('cargo_id');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->tinyInteger('type')->default(0);
            $table->string('last_stocktake')->nullable();
            $table->string('product_key_supplier')->nullable();
            $table->string('weight_last_stocktake')->nullable();
            $table->string('full_pack_last_stocktake')->nullable();
            $table->string('weight_count')->nullable();
            $table->decimal('price_buy',11,2)->default(0);
            $table->decimal('price_sell',11,2)->default(0);
            $table->integer('weight_sell')->default(0);
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
        Schema::dropIfExists('cargo_last_states');
    }
};
