<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('device_loan_start_at')->nullable()->after('remember_token');
            $table->string('device_loan_serial', 191)->nullable()->after('device_loan_start_at');
            $table->tinyInteger('device_loan_notify')->nullable();
            $table->unsignedInteger('device_loan_days')->nullable()->after('device_loan_serial');

            $table->timestamp('device_loan_purchased_at')->nullable()->after('device_loan_days');
            $table->timestamp('device_loan_returned_at')->nullable()->after('device_loan_purchased_at');

            $table->index('device_loan_start_at');
            $table->index('device_loan_purchased_at');
            $table->index('device_loan_returned_at');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['device_loan_start_at']);
            $table->dropIndex(['device_loan_purchased_at']);
            $table->dropIndex(['device_loan_returned_at']);

            $table->dropColumn([
                'device_loan_start_at',
                'device_loan_serial',
                'device_loan_days',
                'device_loan_purchased_at',
                'device_loan_returned_at',
            ]);
        });
    }
};
