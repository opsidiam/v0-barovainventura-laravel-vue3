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
        Schema::create('archive_scans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stocktake_id');
            $table->json('scan_data');
            $table->json('stocktake_data')->nullable();
            $table->date('archive_date');
            $table->timestamps();

            $table->index(['stocktake_id', 'archive_date']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('archive_scans');
    }
};
