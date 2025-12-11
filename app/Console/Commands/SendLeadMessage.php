<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Modules\Admin\Models\Lead;
use App\Mail\SendLeadMessage as SendLead;
use App\Mail\SendLeadCPMessage as SendLeadCP;

class SendLeadMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-lead-message';

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
        $leadsCP = Lead::where('send_cp', 0)
            ->where('send_mail',1)->get();
        foreach($leadsCP as $lead){
            $leadData = json_decode($lead->data, true);
            if (array_key_exists('email', $leadData) || array_key_exists('mail', $leadData)) {
                $email = $leadData['email'] ?? $leadData['mail'];
                $name = $leadData['name'] ?? '';
                $recipient = ['email' => $email, 'name' => $name];
                try {
                    Mail::to($recipient['email'])
                        ->send(new SendLeadCP(
                            subject: 'Tvoja Barová inventúra',
                            recipient: $recipient
                        ));

                    $lead->send_cp = 1;
                    $lead->save();
                    $this->info('Notifikácia "CP" bola odoslaná na ' . $recipient['email'] . '.');

                } catch (\Exception $e) {
                    $this->error('Chyba pri odosielaní notifikácie "CP" ' . $lead->id .' error:'. $e->getMessage());
                    $lead->send_cp = 0;
                    $lead->save();
                }
            } else {
                $lead->send_cp = 2;
                $lead->save();
            }
        }
        $leadsCP = Lead::where('send_lead_message', 0)
            ->where('send_mail',1)->get();
        foreach($leadsCP as $lead){
            $leadData = json_decode($lead->data, true);
            if (array_key_exists('email', $leadData) || array_key_exists('mail', $leadData)) {
                $email = $leadData['email'] ?? $leadData['mail'];
                $name = $leadData['name'] ?? '';
                $recipient = ['email' => $email, 'name' => $name];
                try {
                    Mail::to($recipient['email'])
                        ->send(new SendLead(
                            subject: 'Tvoja Barová inventúra',
                            recipient: $recipient
                        ));

                    $lead->send_lead_message = 1;
                    $lead->save();
                    $this->info('Notifikácia "Lead" bola odoslaná na ' . $recipient['email'] . '.');

                } catch (\Exception $e) {
                    $this->error('Chyba pri odosielaní notifikácie "Lead" ' . $lead->id .' error:'. $e->getMessage());
                    $lead->send_lead_message = 0;
                    $lead->save();
                }
            } else {
                $lead->send_lead_message = 2;
                $lead->save();
            }
        }
    }
}
