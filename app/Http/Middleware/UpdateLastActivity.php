<?php

namespace App\Http\Middleware;

use App\Models\TutorialOpen;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Modules\Admin\Emails\DeviceRequestContractMail;
use Symfony\Component\HttpFoundation\Response;

class UpdateLastActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tutorialShow = 0;
        if(auth()->check()){
            if ($userId = auth()->user()->id) {
                $request->session()->put('last_activity', now());

                $deleted = TutorialOpen::where('user_id', $userId)
                    ->where('position', $request->path())
                    ->delete();

                $tutorialShow = $deleted > 0 ? 1 : 0;
                if($tutorialShow){
                    if($request->path() == 'app/dashboard'){
                        $recipient = $this->getRecipient(auth()->user());
                        $hash = base64_encode(auth()->user()->id);

                        $content = [
                            'user' => auth()->user(),
                            'hash' => $hash
                        ];
                        Mail::to($recipient['email'])->send(
                            new DeviceRequestContractMail(
                                subject: 'Online žiadosť o zapožičanie zariadenia',
                                recipient: $recipient,
                                content: $content
                            )
                        );
                    }
                }
            }
        }


        View::share('tutorial_show', $tutorialShow);

        return $next($request);
    }

    private function getRecipient($user)
    {
        return [
            'email' => $user->email_info_verify == 3 ? $user->email_info : $user->email,
            'name' => $user->name . ' ' . $user->surname
        ];
    }
}
