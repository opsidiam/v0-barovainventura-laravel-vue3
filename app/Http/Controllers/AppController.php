<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
    public function getCheckSession(Request $request){
        if($request->session()->has('bar')){
            return true;
        }
        return false;
    }
}
