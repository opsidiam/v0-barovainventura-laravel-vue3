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
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('brand')->nullable();
            $table->tinyInteger('type')->default(0);
            $table->integer('volume')->default(0);
            $table->float('alcohol')->default(0);
            $table->string('ean')->index();
            $table->integer('weight_full')->nullable()->default(0);
            $table->integer('weight_empty')->nullable()->default(0);
            $table->integer('weight_tolerance')->nullable()->default(5);
            $table->integer('original')->nullable()->default(0);
            $table->tinyInteger('duplicate')->nullable()->default(0);
            $table->longText('parsed_data')->nullable();
            $table->tinyInteger('parsed_svet_napojov')->default(0);
            $table->tinyInteger('created_by_parser')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargos');
    }
};
