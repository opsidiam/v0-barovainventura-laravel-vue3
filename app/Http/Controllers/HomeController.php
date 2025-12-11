<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Admin\Models\Lead;
use Modules\License\Services\LicenseService;

class HomeController extends Controller
{


    public function index(LicenseService $licenseService)
    {
        $data['licenses'] = $licenseService->getAll()->toArray();
        return view('web.home',$data);
    }

    public function about()
    {
        return view('web.about');
    }

    public function contact()
    {
        return view('web.contact');
    }

    public function faq()
    {
        return view('web.faq');
    }

    public function download()
    {
        return view('web.download');
    }

    public function pricelist(LicenseService $licenseService)
    {
        $data['licenses'] = $licenseService->getAll()->toArray();
        return view('web.pricelist',$data);
    }

    public function tutorial()
    {
        return view('web.tutorial');
    }

    public function captcha(Request $request){
        $request->session()->forget('code');
        $captcha_num = 'ABCDEFHIJKLMNPRSTUVWXYZ123456789';
        $captcha_num = substr(str_shuffle($captcha_num), 0, 6);
        $request->session()->put('code', $captcha_num);

        $font_size = 34;
        $img_width =170;
        $img_height = 65;

        header('Content-type: image/jpeg');

        $image = imagecreate($img_width, $img_height); // create background image with dimensions
        imagecolorallocate($image, 255, 255, 255); // set background color

        $text_color = imagecolorallocate($image, 0, 0, 0); // set captcha text color

//        imagettftext($image, $font_size, 5, 10, 53, $text_color, '../public/CodeBars.ttf', $captcha_num);
        imagettftext($image, $font_size, 5, 10, 53, $text_color, '../public/Acme-Regular.ttf', $captcha_num);
        imagejpeg($image);
    }

    public function checkLogin(){
        if (!Auth::check()) {
            return false;
        }

        return true;
    }

    public function gdpr(){
        return view('web.gdpr');
    }

    public function vop(){
        return view('web.vop');
    }

    public function requestQuote(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        try {
            $existingLead = Lead::where('data', 'like', '%"email":"' . request()->email . '"%')->first();

            if ($existingLead) {
                return back()->with('warning', 'Daný email už existuje.');
            }
            Lead::create([
                'source' => 'web',
                'data' => json_encode(['typ' => 'cp', 'email' => request()->email, 'created_at' => Carbon::now()]),
                'send_lead_message' => 2,
                'send_cp' => 0
            ]);

            return back()->with('message', 'Podnet bol úspešne odoslaný.');

        } catch (\Exception $e) {
            Log::error('Support form submission failed: ' . $e->getMessage());
            return back()->with('error', 'Nastala chyba pri odosielaní. Skúste to prosím neskôr.'.$e->getMessage());
        }
    }

    public function newsletterSubscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        try {
            $existingLead = Lead::where('data', 'like', '%"email":"' . request()->email . '"%')->first();

            if ($existingLead) {
                return back()->with('warning', 'Daný email už existuje.');
            }
            Lead::create([
                'source' => 'web',
                'data' => json_encode(['typ' => 'newsletter', 'email' => request()->email, 'created_at' => Carbon::now()]),
                'send_lead_message' => 2,
                'send_cp' => 2
            ]);

            return back()->with('message', 'Newsletter bol úspešne odoslaný.');

        } catch (\Exception $e) {
            Log::error('Support form submission failed: ' . $e->getMessage());
            return back()->with('error', 'Nastala chyba pri odosielaní. Skúste to prosím neskôr.'.$e->getMessage());
        }
    }

    public function contactForm(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|min:2|max:50',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:30',
            'message' => 'required|string|min:5',
            'agree'   => 'accepted'
        ]);

        try {
            Lead::create([
                'source' => 'web',
                'data'   => json_encode([
                    'typ'        => 'contact',
                    'name'       => $request->name,
                    'email'      => $request->email,
                    'phone'      => $request->phone,
                    'message'    => $request->message,
                    'created_at' => Carbon::now()
                ]),
                'send_lead_message' => 2,
                'send_cp' => 2
            ]);

            return back()->with('message', __('web.contact.success'));

        } catch (\Exception $e) {
            Log::error('Contact form failed: ' . $e->getMessage());
            return back()->with('error', __('web.contact.error'));
        }
    }
}
