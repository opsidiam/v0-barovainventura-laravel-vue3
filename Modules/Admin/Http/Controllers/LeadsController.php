<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Modules\Admin\Models\Lead;
use Modules\Admin\Services\LeadService;

class LeadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin::leads.index');
    }
    /**
     * Display a listing of the resource.
     */

    public function show (Lead $lead)
    {
        return view('admin::leads.edit', compact('lead'));
    }

    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        return view('admin::leads.create');
    }
    /**
     * Display a listing of the resource.
     */
    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'source'    => 'required|in:fb,ig,web,admin',
            'status'    => 'nullable|in:new,contact,waiting,close',
            'open'      => 'nullable|boolean',
            'send_mail' => 'nullable|boolean',
            'data'      => 'required|json',
        ]);

        $data = json_decode($validated['data'], true);

        foreach (['meno', 'email'] as $field) {
            if (empty($data[$field])) {
                return back()
                    ->withErrors(["Pole {$field} je povinné."])
                    ->withInput();
            }
        }

        $lead->source            = $validated['source'] ?? $lead->source;
        $lead->status            = $validated['status'] ?? $lead->status;
        $lead->open              = array_key_exists('open', $validated) ? (int)$validated['open'] : $lead->open;

        $lead->send_mail         = $request->has('send_mail') ? 0 : 2;
        $lead->send_lead_message = $request->has('send_lead_message') ? 0 : 2;
        $lead->send_cp           = $request->has('send_cp') ? 0 : 2;

        $lead->data = json_encode($data, JSON_UNESCAPED_UNICODE);
        $lead->save();

        return redirect()
            ->route('admin.leads.index')
            ->with('success', 'Lead bol úspešne aktualizovaný.');
    }

    /**
     * Uloženie nového leadu
     */
    public function store(Request $request)
    {
        // validácia vstupov
        $validated = $request->validate([
            'source'    => 'required|in:fb,ig,web,admin',
            'status'    => 'nullable|in:new,contact,waiting,close',
            'open'      => 'nullable|boolean',
            'send_mail' => 'nullable|boolean',
            'data'      => 'required|json',
        ]);
        $data = json_decode($validated['data'], true);

        foreach (['meno', 'email'] as $field) {
            if (empty($data[$field])) {
                return back()
                    ->withErrors(["Pole {$field} je povinné."])
                    ->withInput();
            }
        }

        $lead = new Lead();
        $lead->source    = $validated['source'] ?? 'admin';
        $lead->status    = $validated['status'] ?? 'new';
        $lead->open      = $validated['open'] ?? 1;
        $lead->send_mail         = 2;
        $lead->send_lead_message = 2;
        $lead->send_cp           = 2;
        $lead->data      = json_encode($data);
        $lead->save();

        return redirect()
            ->route('admin.leads.index')
            ->with('success', 'Lead bol úspešne vytvorený.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function destroy(LeadService $leadService, $id)
    {
        $data = $leadService->destroy($id);
        if($data){
            return back()->with('message',__('admin.messages.success.lead-delete'));
        }
        return back()->with('warning','Nastala chyba');
    }

    public function resendLeads(Request $request, $id)
    {
        $type = (string) $request->query('type');
        $allowed = ['send_mail', 'send_mail_off', 'send_lead_message', 'send_cp'];

        if (!in_array($type, $allowed, true)) {
            return back()->with('warning', 'Neplatný typ notifikácie.');
        }

        $lead = Lead::findOrFail($id);

        // Normalizuj JSON data -> array
        $data = is_array($lead->data)
            ? $lead->data
            : (json_decode($lead->data ?? '[]', true) ?: []);

        // Zisti, či už je akcia hotová
        $already = false;
        switch ($type) {
            case 'send_mail':
                $already = (int)($lead->send_mail ?? 0) === 1;
                break;
            case 'send_mail_off':
                $already = (int)($lead->send_mail ?? 0) === 2;
                break;
            case 'send_lead_message':
            case 'send_cp':
                $already = (int)($lead->{$type} ?? 0) === 1;
                break;
        }
        if ($already) {
            return back()->with('warning', 'Táto akcia už bola vykonaná.');
        }

        Log::info('[Lead notify] Action', [
            'lead_id' => $lead->id,
            'type'    => $type,
            'email'   => $data['email'] ?? null,
        ]);

        $data[$type] = now()->toDateTimeString();
        $lead->data = $data;

        switch ($type) {
            case 'send_mail':       $lead->send_mail = 1; break; // povolené/odoslané
            case 'send_mail_off':   $lead->send_mail = 2; break; // blokované
            case 'send_lead_message':
            case 'send_cp':         $lead->{$type} = 0; break;   // odoslané
        }

        $lead->save();

        return back()->with('message', 'Akcia bola vykonaná.');
    }

}
