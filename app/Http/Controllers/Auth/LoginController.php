<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Modules\User\Models\LoginHistory;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/app/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->only('logout');
    }

    public function showLoginForm(Request $request)
    {
        if (auth()->check()) {
            return redirect()->intended($this->redirectTo);
        }

        return view('auth.login');
    }

    protected function authenticated(Request $request, $user)
    {
        $user->last_seen_at = Carbon::now()->format('Y-m-d H:i:s');
        $user->missing_mail_send = 0;
        $user->save();

        $data = [
            'login_ip' => $request->ip() ?? null,
            'user_agent' => $request->userAgent() ?? null,
            'login_time' => Carbon::now(),
            'success' => true,
        ];
        $login_history = new LoginHistory($data);
        $user->loginHistory()->save($login_history);
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'redirect' => redirect()->intended()->getTargetUrl()
            ]);
        }
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => false,
                'message' => trans('auth.failed')
            ], 401);
        }

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }
}
