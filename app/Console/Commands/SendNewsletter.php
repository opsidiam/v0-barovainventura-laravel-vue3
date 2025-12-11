<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendNewsletterEmail;
use Modules\Newsletter\Models\Newsletter;
use Modules\Newsletter\Models\NewsletterSend;

class SendNewsletter extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-newsletter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Odosielanie newsletterov používateľom';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $newsletters = Newsletter::where('sending_done', false)
            ->where('ready_to_send', true)
            ->first();

        if(!empty($newsletters)) {
            $users = User::whereNotNull('email_info')->where('email_info_verify',3)->get();
            foreach($users as $user) {
                NewsletterSend::insert([
                    'newsletter_id' => $newsletters->id,
                    'recipient_email' => $user->email_info,
                    'recipient_name' => $user->name .' '.$user->surname,
                    'sending_done' => 0,
                ]);
            }
            $newsletters->sending_done = 1;
            $newsletters->save();
        }

        $sendMails = NewsletterSend::with('newsletter')->where('sending_done',0)->get();
        if(!empty($sendMails)) {
            foreach ($sendMails as $sendMail) {
                $recipient = ['email' => $sendMail->recipient_email, 'name' => $sendMail->recipient_name];
                try {
                    Mail::to($recipient['email'])
                        ->send(new SendNewsletterEmail(
                            subject: $sendMail->newsletter->subject,
                            recipient: $recipient,
                            content: $sendMail->newsletter->message
                        ));

                    $sendMail->sending_done = 1;
                    $sendMail->sending_status = 1;
                    $sendMail->save();

                    $this->info('Newsletter "' . $sendMail->newsletter->subject . '" bol odoslaný ' . $recipient['email'] . '.');

                } catch (\Exception $e) {
                    $this->error('Chyba pri odosielaní newsletteru ' . $sendMail->id);
                    $sendMail->sending_done = 1;
                    $sendMail->sending_status = 2;
                    $sendMail->error = $e->getMessage();
                    $sendMail->save();
                }
            }
        }

    }
}
