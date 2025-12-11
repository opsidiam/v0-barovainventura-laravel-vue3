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
        Schema::create('newsletter_sends', function (Blueprint $table) {
            $table->id();
            $table->string('recipient_email')->nullable();
            $table->string('recipient_name')->nullable();
            $table->tinyInteger('sending_done')->default(0);
            $table->integer('sending_status')->nullable();
            $table->text('error')->nullable();
            $table->unsignedBigInteger('newsletter_id')->nullable();
            $table->timestamps();

            $table->foreign('newsletter_id')
                ->references('id')
                ->on('newsletters')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newsletter_sends');
    }
};
