<?php

namespace Modules\User\Services;

use App\Models\User;

class UserService
{
    public function handle() {}

    public function loginHistory()
    {
        $user = User::findOrFail(auth()->user()->id);
        return $user->loginHistory()->orderByDesc('created_at')->get();
    }
    public function orderHistory()
    {
        $user = User::findOrFail(auth()->user()->id);
        return $user->orderHistory()->whereNotNull('pay_url')->orderByDesc('created_at')->get();
    }

    public function emailVerifyToken($token)
    {
        if(strlen($token) > 5){
            if(User::where('email_info_token', $token)->count() > 0){
                $user = User::where('email_info_token', $token)->first();
                $user->email_info_verify = 3;
                $user->save();

                $data = [
                    'name' => $user->name,
                    'surname' => $user->surname,
                    'email' => $user->email,
                ];
                return $data;
            }
            return [];
        }
        return [];
    }

    public function emailInvoiceVerifyToken($token)
    {
        if(strlen($token) > 5){
            if(User::where('email_invoice_token', $token)->count() > 0){
                $user = User::where('email_invoice_token', $token)->first();
                $user->email_invoice_verify = 3;
                $user->save();
                $data = [
                    'name' => $user->name,
                    'surname' => $user->surname,
                    'email' => $user->email,
                ];
                return $data;
            }
            return [];
        }
        return [];
    }
}
