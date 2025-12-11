<?php

namespace Modules\Admin\Services;

use App\Helpers\ApiInvoice;
use Carbon\Carbon;

class ApiService
{
    private function invoiceLogin()
    {
        $service = new ApiInvoice;
        return $service->login(config('app.invoice_email'),config('app.invoice_pass'));
    }

    public function invoiceCheckIfExistUser($name, $email)
    {
        $service = new ApiInvoice;
        $token = $this->invoiceLogin();
        $customers = $service->getAllCustomers($token->token);

        return $this->searchUser($customers, $name, $email);
    }

    public function invoiceCreateUser($contract, $user)
    {
        $service = new ApiInvoice;
        $token = $this->invoiceLogin();

        $name = $contract->name .' '.$contract->surname;
        $ico = null;
        if($contract->company){
            $name = $contract->company;
            $ico = $contract->date_ico;
        }
        $data = [
            'name' => $name,
            'email' => $user->email,
            'address' => $contract->address ?? '-',
            'address_number' => '',
            'ico' => str_replace(' ','',$ico) ?? null,
            'address_city' => $contract->city ?? '-',
            'address_city_number' => $contract->postal ?? '-',
            'address_country' => $contract->country ?? '-',
            'dic' =>  null,
            'suppliers_id' => 1,
            'ic_dph' =>  null,
        ];

        return $service->postCreateCustomer($token->token, $data);
    }

    public function invoiceStageCreate($user)
    {
        $service = new ApiInvoice;
        $token = $this->invoiceLogin();
        $item = '[{"name":"Skener + váha","desc":"Zapožičanie zariadenia na skúšku, poštovné a balné1","count":"1","price":1000}]';
        $data = [
            'supplier' => 1,
            'customer' => $user->id,
            'date_issue' => Carbon::now()->format('Y-m-d'),
            'date_delivery' => Carbon::now()->format('Y-m-d'),
            'date_due' => Carbon::now()->addDays(14)->format('Y-m-d'),
            'bank' => 1,
            'payed' => 0,
            'month' => (int)date('m'),
            'year' => (int)date('Y'),
            'vat' => 0,
            'items' => $item,
            'total_price' => 1000,
            'send_mail_text' => 'Týmto Vám zasielame faktúru, ktorá bola vystavená automaticky systémom. Ak si všimnete nejakú chybu, neváhajte nás kontaktovať na emailovej adrese info@web-place.sk.',
            'send_mail' => 1,
        ];
        $response = $service->postCreateInvoice($token->token, $data);

        if(empty($response->file)){
           return false;
        }
        return $response;
    }

    public function invoiceSendToMail($invoiceId, $email)
    {
        $service = new ApiInvoice;
        $token = $this->invoiceLogin();
        $data = [
            'email' => $email
        ];
        $response = $service->postSendInvoice($token->token,$data,$invoiceId);
        return $response;
    }

    public function invoiceGet($invoice)
    {
        $service = new ApiInvoice;
        $token = $this->invoiceLogin();
        $data = [
            'number' => $invoice
        ];
        $response = $service->getInvoices($token->token,$data);
        return $response;
    }

    function searchUser($customers, $name, $email) {
        foreach($customers as $customer){
            if(!empty($customer->name) && !empty($name) && !empty($customer->ico) && !empty($email)){
                if($customer->name === $name && str_replace(' ','',$customer->email) === str_replace(' ','',$email)) {
                    return $customer;
                }
            }
        }
        return false;
    }
}
