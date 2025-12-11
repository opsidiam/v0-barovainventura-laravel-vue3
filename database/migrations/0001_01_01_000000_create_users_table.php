<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('reference')->nullable();
            $table->tinyInteger('permission')->default(0);
            $table->tinyInteger('licences_category')->default(3);
            $table->string('email_info')->nullable();
            $table->tinyInteger('email_info_verify')->nullable();
            $table->string('email_info_token')->nullable();
            $table->string('email_invoice')->nullable();
            $table->tinyInteger('email_invoice_verify')->nullable();
            $table->string('email_invoice_token')->nullable();
            $table->tinyInteger('close_stocktake_notification')->default(0);
            $table->string('invoice_phone')->nullable();
            $table->string('invoice_name')->nullable();
            $table->string('invoice_surname')->nullable();
            $table->string('invoice_company_name')->nullable();
            $table->string('invoice_address')->nullable();
            $table->string('invoice_psc')->nullable();
            $table->string('invoice_city')->nullable();
            $table->string('invoice_stat')->nullable();
            $table->string('invoice_ico')->nullable();
            $table->string('invoice_dic')->nullable();
            $table->string('invoice_icdph')->nullable();
            $table->integer('licence_bar_count')->default(1);
            $table->timestamp('licence_expire')->nullable();
            $table->enum('licence_last_notify',['last_week','last_day','expire'])->nullable();
            $table->rememberToken();
            $table->timestamp('last_seen_at')->nullable();
            $table->tinyInteger('missing_mail_send')->default(0);
            $table->foreignId('partner_id')->nullable()->constrained('partners')->nullOnDelete();
            $table->timestamps();
        });
        DB::statement("
            ALTER TABLE users
            MODIFY licence_expire TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ");

        DB::statement("
            CREATE TRIGGER set_user_licence_expire
            BEFORE INSERT ON users
            FOR EACH ROW
            SET NEW.licence_expire = DATE_ADD(NOW(), INTERVAL 30 DAY)
        ");
//        DB::statement("ALTER TABLE users
//    MODIFY licence_expire TIMESTAMP NOT NULL
//    DEFAULT (CURRENT_TIMESTAMP + INTERVAL 30 DAY)");

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
