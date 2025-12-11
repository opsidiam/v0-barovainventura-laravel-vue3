<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeEmail;
use App\Models\TutorialOpen;
use App\Models\User;
use App\Models\SmsNotifications;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/app/bar';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'email' => $data['email'],
            'licence_expire' => now()->addMonth(),
            'licence_bar_count' => 1,
            'reference' => $data['reference'],
            'invoice_phone' => $data['phone'],
            'last_seen_at' => Carbon::now(),
            'password' => Hash::make($data['password']),
        ]);
        $positions = ['app/bar', 'app/dashboard', 'app/stocktake/create', 'app/item'];

        $rows = array_map(fn ($pos) => [
            'user_id'    => $user->id,
            'position'   => $pos
        ], $positions);

        TutorialOpen::insertOrIgnore($rows);

        $phones = Arr::wrap(config('app.phones'));

        $normalizeName = function ($first, $last) {
            $s = trim(($first ?? '') . ' ' . ($last ?? ''));
            if ($s === '') return '';
            if (function_exists('transliterator_transliterate')) {
                return transliterator_transliterate('Any-Latin; Latin-ASCII', $s);
            }
            if (function_exists('iconv')) {
                $t = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $s);
                if ($t !== false) return $t;
            }
            return $s;
        };

        $message = 'Nova registracia na BarovaInventura.sk%0A' .
            $normalizeName($data['name'] ?? '', $data['surname'] ?? '');

        foreach ($phones as $phone) {
            if (!is_string($phone) || trim($phone) === '') continue;

            rescue(
                function () use ($phone, $user, $message) {
                    SmsNotifications::create([
                        'phone'      => $phone,
                        'user_id'    => $user->id,
                        'send_allow' => 1,
                        'message'    => $message,
                    ]);
                },
                function (\Throwable $e) use ($phone, $user) {
                    Log::warning('Zlyhalo vytvorenie SMS notifikácie', [
                        'phone'   => $phone,
                        'user_id' => $user->id,
                        'error'   => $e->getMessage(),
                    ]);
                    return null;
                }
            );
        }

        Mail::to($user->email)->send(new WelcomeEmail($user));
        return $user;
    }
}
