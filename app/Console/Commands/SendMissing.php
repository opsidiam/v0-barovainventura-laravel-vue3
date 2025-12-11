<?php

namespace App\Console\Commands;

use App\Mail\SendMissingEmail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendMissing extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-missing';

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
        $missingMail = User::where('last_seen_at','<',now()->subMonth())
            ->where('missing_mail_send', 0)
            ->get();

        if(!empty($missingMail)) {
            foreach($missingMail as $mail) {
                $recipient = ['email' => $mail->email, 'name' => $mail->name.' '.$mail->surname];
                try {
                    Mail::to($recipient['email'])
                        ->send(new SendMissingEmail(
                            subject: 'Chýbaš nám | Barova inventura',
                            recipient: $recipient,
                            content: $missingMail
                        ));

                    $mail->missing_mail_send = 1;
                    $mail->save();
                    $this->info('Notifikácia "Chýbaš nám" bola odoslaná na ' . $recipient['email'] . '.');

                } catch (\Exception $e) {
                    $this->error('Chyba pri odosielaní notifikácie "Chýbaš nám" ' . $mail->id .' error:'. $e->getMessage());
                    $mail->missing_mail_send = 0;
                    $mail->save();
                }
            }
        }
    }
}
