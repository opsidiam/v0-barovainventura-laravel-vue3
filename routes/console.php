<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('app:check-pay-status')->everyMinute();
Schedule::command('app:check-user-license')->everyMinute();
Schedule::command('app:calculate-stocktake')->everyMinute();
Schedule::command('app:check-stocktake')->everyTwoHours();
Schedule::command('app:send-stocktake-to-mail')->everyMinute();
Schedule::command('app:send-newsletter')->everyMinute();
Schedule::command('app:send-missing')->everyMinute();
Schedule::command('app:send-sms-notify')->everyMinute();
Schedule::command('app:send-lead-message')->everyMinute()->between('7:00', '20:00');
Schedule::command('app:check-user-loan-device')->everyMinute()->between('7:00', '20:00');
Schedule::command('app:parse-products')->dailyAt('01:00');
