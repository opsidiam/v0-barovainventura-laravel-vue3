<?php

namespace Modules\Setting\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\User\Emails\SendNotificationEmail;

class SettingService
{
    public function handle() {}

    public function postUpdateEmail()
    {
        $user = auth()->user();
        try {
            $return = 4;


            $token = date('hi').'_'.rand(100000000, 999999999);
            $data['token'] = $token;

            // Validate input
            request()->validate([
                'email_info' => 'nullable|email',
                'close_stocktake_notification' => 'nullable|string'
            ]);

            // Handle email change
            if (request()->filled('email_info') && request('email_info') != $user->email_info) {

                $user->email_info = request()->email_info;
                $user->email_info_verify = 0;
                $user->email_info_token = $token;
                $user->save();

                $data['data'][] = ['E-mail', request('email_info')];
                $data['token'] = $token;
            } elseif ($user->email_info_verify != 3) {
                $return = 3;
            }
            if ($return != 3) {
                $notificationValue = request()->has('close_stocktake_notification') ? 1 : 0;

                if ($user->close_stocktake_notification != $notificationValue) {
                    $user->close_stocktake_notification = $notificationValue;

                    $user->save();

                    $status = $notificationValue ? 'Zapnuté' : 'Vypnuté';
                    $data['data'][] = ['Zaslať ukončenie inventúry na e-mail', $status];
                    $return = 0;
                }
            }
            if($return == 3){
                $return = $this->sendMailChangeInfoMail('verify_email', $data);
            }
            if($return == 0){
                $return = $this->sendMailChangeInfoMail('update_settings', $data);
            }
        } catch (\Exception $e) {
            Log::error('Email update failed: '.$e->getMessage());
            $return = 4;
        }
    }

    public function postUpdateInvoice()
    {
        $user = auth()->user();
        $data = [];
        $return = 0;

        try {
            request()->validate([
                'email_invoice' => 'nullable|email',
                'invoice_phone' => 'nullable|string',
                'invoice_name' => 'nullable|string',
                'invoice_surname' => 'nullable|string',
                'invoice_address' => 'nullable|string',
                'invoice_psc' => 'nullable|string',
                'invoice_city' => 'nullable|string',
                'invoice_stat' => 'nullable|string',
                'invoice_ico' => 'nullable|string',
                'invoice_dic' => 'nullable|string',
                'invoice_icdph' => 'nullable|string'
            ]);
            $token = date('hi').'_'.rand(100000000, 999999999);
            $data['token'] = $token;
            if (request()->filled('email_invoice') && request()->email_invoice != $user->email_invoice) {

                $user->email_invoice = request()->email_invoice;
                $user->email_invoice_verify = 0;
                $user->email_invoice_token = $token;

                $data['data'][] = ['E-mail', request()->email_invoice];
                $return = $this->sendMailChangeInfoMail('verify_invoice_email', $data);
            } elseif ($user->email_invoice_verify === 3) {
                $return = 0;
            } else {
                $data['data'][] = ['E-mail', request()->email_invoice];
                $return = $this->sendMailChangeInfoMail('verify_invoice_email', $data);
            }

            $fields = [
                'invoice_phone' => ['Telefónne číslo', 'string'],
                'invoice_name' => ['Meno / Názov fakturanta', 'string'],
                'invoice_surname' => ['Priezvisko', 'string'],
                'invoice_company_name' => ['Názov spoločnosti', 'string'],
                'invoice_address' => ['Adresa fakturanta', 'string'],
                'invoice_psc' => ['PSČ fakturanta', 'string'],
                'invoice_city' => ['Mesto fakturanta', 'string'],
                'invoice_stat' => ['Štát fakturanta', 'string'],
                'invoice_ico' => ['IČO', 'string'],
                'invoice_dic' => ['DIČ', 'string'],
                'invoice_icdph' => ['IČ DPH', 'string']
            ];

            foreach ($fields as $field => [$label, $type]) {
                if (request()->filled($field) && request()->$field != $user->$field) {
                    $user->$field = request()->$field;
                    $data['data'][] = [$label, request()->$field];
                }
            }

            $user->save();

            if ($return != 3 && !empty($data['data'])) {
                $return = $this->sendMailChangeInfoMail('update_invoice_data', $data);
            }

        } catch (\Exception $e) {
            Log::error('Invoice update failed: '.$e->getMessage());
            $return = 4;
        }
        return $return;
    }



    private function sendMailChangeInfoMail($type, $data)
    {
        $data['type'] = $type;
        $user = Auth::user();
        if($type == 'verify_email'){
            $user->email_info = request('email_info') ?? null;
            $user->email_info_token = $data['token'] ?? null;
        }
        if($type == 'verify_invoice_email'){
            $user->email_invoice = request('email_invoice') ?? null;
            $user->email_invoice_token = $data['token'] ?? null;
        }
        $user->save();
        if(in_array($type, ['update_settings'])){
            if (!$user->email_info) {
                return 2;
            }

            if ($user->email_info_verify != 3) {
                return 3;
            }
        }

        try {
            $recipient = $this->getRecipient($type, $user);
            $email = new SendNotificationEmail(
                subject: $this->getSubject($type),
                recipient: $recipient,
                content: $data ?? null,
            );

            Mail::to($recipient['email'])->send($email);
            if (in_array($type, ['update_settings'])
                && $user->email_info_verify == 3) {
                return 0;
            }elseif (in_array($type, ['update_invoice_data'])
                && $user->email_invoice_verify == 3) {
                return 0;
            } else {
                return 3;
            }

        } catch (\Exception $e) {
            Log::error('Email sending failed: '.$e->getMessage());
            return 1;
        }


    }

    private function getSubject($type)
    {
        $subjects = [
            'update_settings' => 'Zmena nastavenia',
            'update_invoice_data' => 'Zmena fakturačných údajov',
            'verify_email' => 'Overenie e-mailovej adresy',
            'verify_invoice_email' => 'Overenie e-mailovej adresy pre faktúry',
        ];

        return $subjects[$type] ?? 'Notifikácia';
    }
    private function getRecipient($typs, $user)
    {
        if ($typs == 'verify_invoice_email') {
            return [
                'email' => $user->email_invoice,
                'name' => $user->invoice_name.' '.$user->invoice_surname
            ];
        }

        return [
            'email' => $user->email_info,
            'name' => $user->name.' '.$user->surname
        ];
    }
}
