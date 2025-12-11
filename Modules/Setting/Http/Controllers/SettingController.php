<?php

namespace Modules\Setting\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Setting\Services\SettingService;
use Modules\User\Emails\SendActivationLicenseEmail;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('setting::index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('setting::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store() {}

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('setting::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('setting::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id) {}

    public function postUpdateEmail(SettingService $settingService)
    {
        $return = $settingService->postUpdateEmail();
        switch ($return) {
            case 0:
                return back()->with('message','Dáta boli úspešne aktualizované. Skontrolujte si e-mailovú schránku.');
            case 1:
                return back()->with('error','Chyba pri odosielaní emailu.');
            case 2:
                return back()->with('error','Nebol zadaný žiadny email.');
            case 3:
                return back()->with('warning','E-Mail ešte nebol potvrdený, najprv potvrďte emailovú adresu.');
            default:
                return back()->with('error','Neboli vykonané žiadne zmeny.');
        }
    }

    public function postUpdateInvoice(SettingService $settingService)
    {
        $return = $settingService->postUpdateInvoice();

        switch ($return) {
            case 0:
                return back()->with('message', 'Dáta boli úspešne aktualizované. Skontrolujte si e-mailovú schránku.');
            case 1:
                return back()->with('error', 'Chyba pri odosielaní emailu.');
            case 2:
                return back()->with('error', 'Nebol zadaný žiadny email.');
            case 3:
                return back()->with('warning', 'E-Mail ešte nebol potvrdený, najprv potvrďte emailovú adresu.');
            default:
                return back()->with('error', 'Neboli vykonané žiadne zmeny.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id) {}
}
