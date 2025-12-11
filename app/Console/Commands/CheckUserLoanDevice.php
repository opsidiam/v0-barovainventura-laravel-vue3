<?php

namespace App\Console\Commands;

use App\Models\SmsNotifications;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class CheckUserLoanDevice extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-user-loan-device';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $phones = Arr::wrap(config('app.phones'));
        $users = User::where('device_loan_notify', null)
            ->whereNotNull('device_loan_start_at')->get();
        foreach($users as $user){
            $dateExpire = Carbon::parse($user->device_loan_start_at)->addDays($user->device_loan_days);
            if($dateExpire < Carbon::now()){
                $normalizeName = function ($first, $last) {
                    $s = trim(($first ?? '') . ' ' . ($last ?? ''));
                    if ($s === '') return '';
                    if (function_exists('transliterator_transliterate')) {
                        return transliterator_transliterate('Any-Latin; Latin-ASCII', $s);
                    }
                    if (function_exists('iconv')) {
                        $t = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $s);
                        if ($t !== false) return $t;
                    }
                    return $s;
                };
                $message = 'Zapozicane zariadenia expirovali.%0A Uzivatel: '.
                    $normalizeName($user->name ?? '', $user->surname ?? '');
                foreach ($phones as $phone) {
                    if (!is_string($phone) || trim($phone) === '') continue;

                    rescue(
                        function () use ($phone, $user, $message) {
                            SmsNotifications::create([
                                'phone'      => $phone,
                                'user_id'    => $user->id,
                                'send_allow' => 1,
                                'message'    => $message,
                            ]);
                        },
                        function (\Throwable $e) use ($phone, $user) {
                            Log::error('Zlyhalo vytvorenie SMS notifikácie', [
                                'phone'   => $phone,
                                'user_id' => $user->id,
                                'error'   => $e->getMessage(),
                            ]);
                            return null;
                        }
                    );
                }
                $user->device_loan_notify = 1;
                $user->save();
            }
        }
    }
}
