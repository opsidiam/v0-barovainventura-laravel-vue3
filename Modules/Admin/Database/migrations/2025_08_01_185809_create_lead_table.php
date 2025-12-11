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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->enum('source',['fb', 'ig', 'web', 'admin'])->default('web');
            $table->json('data');
            $table->enum('status',['new', 'contact', 'waiting', 'close'])->default('new');
            $table->boolean('open')->default(1);
            $table->boolean('send_mail')->default(0);
            $table->boolean('send_lead_message')->default(0);
            $table->boolean('send_cp')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
