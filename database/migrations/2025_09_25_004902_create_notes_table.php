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
        Schema::create('notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            // polymorfné väzby: user, bar, file
            $table->string('notable_type', 191);
            $table->unsignedBigInteger('notable_id');
            // autor poznámky
            $table->unsignedBigInteger('author_id')->index();
            $table->text('body');
            $table->timestamps();

            $table->index(['notable_type', 'notable_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
