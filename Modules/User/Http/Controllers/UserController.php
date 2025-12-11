<?php

namespace Modules\User\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\User\Services\UserService;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect()->route('dashboard.index');
    }

    public function getLoginHistory(UserService $userService)
    {
        $data['login_history'] = $userService->loginHistory();
        return view('user::login-history', $data);
    }

    public function getOrderHistory(UserService $userService)
    {
        $data['order_history'] = $userService->orderHistory();
        return view('user::order-history', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('user::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('user::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id) {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}

    public function emailVerifyToken(UserService $userService, $token)
    {
        $data = $userService->emailVerifyToken($token);

        return view('user::verify.verify-info-email')->with($data);
    }

    public function emailInvoiceVerifyToken(UserService $userService, $token)
    {
        $data = $userService->emailInvoiceVerifyToken($token);
        return view('user::verify.verify-invoice-email')->with($data);
    }
}
