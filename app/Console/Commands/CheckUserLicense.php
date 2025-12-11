<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\License\Emails\SendExpireLicenseEmail;
use Modules\Notification\Models\Notification;

class CheckUserLicense extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-user-license';

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
        $users = User::where('licence_expire','>',now()->subDay())
            ->where('licence_expire','<',now()->addDays(8))
            ->get();
        foreach($users as $user){
            if(now() > $user->licence_expire){//expiracia
                if($user->licence_last_notify == 'expire') continue;
                $user->licence_last_notify = 'expire';
                if($this->sendMailChangeInfoMail($user, 'expire')){
                    $this->createNotification($user, 'expire');
                    $user->save();
                    continue;
                }
            }
            if(now()->addDay() > $user->licence_expire){//last day
                if($user->licence_last_notify == 'last_day') continue;
                $user->licence_last_notify = 'last_day';
                if($this->sendMailChangeInfoMail($user, 'last_day')){
                    $this->createNotification($user, 'last_day');
                    $user->save();
                    continue;
                }
            }
            if(now()->addWeek() > $user->licence_expire){//7 day
                if($user->licence_last_notify == 'last_week') continue;
                $user->licence_last_notify = 'last_week';
                if($this->sendMailChangeInfoMail($user, 'last_week')){
                    $this->createNotification($user, 'last_week');
                    $user->save();
                }
            }
        }
    }

    private function sendMailChangeInfoMail($user, $type)
    {
        try {
            $recipient = $this->getRecipient($user);
            $email = new SendExpireLicenseEmail(
                subject: $this->getSubject($type),
                recipient: $recipient,
                content: ['user' => $user,'type' => $type] ?? null,
            );
            $send = (bool)Mail::to($recipient['email'])->send($email);
            Log::channel('success')->info('{Commands/CheckUserLicense} Email sending success to:'. $recipient['email']);
            return $send;



        } catch (\Exception $e) {
            Log::error('{Commands/CheckUserLicense} Email sending failed: '.$e->getMessage());
            return false;
        }


    }
    private function getRecipient($user)
    {
        return [
            'email' => $user->email_info_verify == 3 ? $user->email_info : $user->email,
            'name' => $user->name.' '.$user->surname
        ];
    }

    private function getSubject($type)
    {
        switch ($type) {
            case 'last_week':
                return 'Obnovenie licencie: Váš prístup k Barovej Inventúre je aktívny do ' . date('d.m.Y', strtotime('+1 week'));

            case 'last_day':
                return 'Posledný deň: Obnovte svoj prístup k Barovej Inventúre';

            case 'expire':
                return 'Pokračujte v používaní Barovej Inventúry - Obnovte prístup';

            default:
                return 'Informácie k vášmu účtu v Barovej Inventúre';
        }
    }

    private function createNotification(User $user, string $type)
    {
        $message = $this->getNotificationMessage($user, $type);

        Notification::create([
            'type' => ($type == 'expire')? 'error' :'warning',
            'scope' => 'user',
            'message' => $message,
            'user_id' => $user->id,
            'bar_id' => null,
            'url' => route('license.index')
        ]);
    }

    private function getNotificationMessage(User $user, string $type): string
    {
        $expireDate = $user->licence_expire->format('d.m.Y');

        switch ($type) {
            case 'last_week':
                return "Vaša licencia expiruje o týždeň ($expireDate). Prosím, obnovte si ju čo najskôr.";

            case 'last_day':
                return "Posledná výzva: Vaša licencia expiruje zajtra ($expireDate)!";

            case 'expire':
                return "Vaša licencia expirovala dňa $expireDate. Prístup k systému môže byť obmedzený.";

            default:
                return "Upozornenie na licenciu (expiruje: $expireDate)";
        }
    }
}
