<?php

namespace App\Console\Commands;

use App\Models\SmsNotifications;
use Illuminate\Console\Command;

class SendSmsNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-sms-notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private function authSmsGate(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.smsgate.sk/json/auth?token=64d843f359aeb905ecf1b18405ab68a895316c317bc248384414d7b735addcc3',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

    private function sendSmsGate($session_id, $to, $text){
        if(isset($session_id) and isset($to) and isset($text)){
            $text = str_replace(' ', '%20', $text);
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.smsgate.sk/json/send_message?session_id='.$session_id.'&from=WebPlace&to='.$to.'&text='.$text.'&callback=true&unicode=false',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response);
        }
        return false;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $smsAuth = $this->authSmsGate();
        if($smsAuth->result->status == 'success'){
            foreach(SmsNotifications::where([['send_allow',1],['send',0]])->get() as $sms){
                $phone = $sms->phone;
                $phone = str_replace(' ', '', $phone);
                $phone = str_replace('+', '00', $phone);
                $sms_send = $this->sendSmsGate($smsAuth->session_id, $phone, $sms->message);

                if ($sms_send->result->status == 'success') {
                    SmsNotifications::where('id', $sms->id)->update([
                        'send' => 1,
                        'sms_id' => $sms_send->messages[0]->message_id,
                        'status' => $sms_send->messages[0]->status,
                        'code' => $sms_send->messages[0]->code,
                    ]);
                } else {
                    SmsNotifications::where('id', $sms->id)->update([
                        'send' => 1,
                        'sms_id' => 0,
                        'status' => $sms_send->result->description,
                        'code' => $sms_send->result->code,
                    ]);
                }
            }
        }
        return Command::SUCCESS;
    }
}
