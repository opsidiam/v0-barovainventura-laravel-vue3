<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\User\Models\Support;

class SupportController extends Controller
{

    public function supportContactForm(){
        return view('web.support.contactForm');
    }
    public function supportContactFormPost(Request $request)
    {
        // Validate request
        $validated = $request->validate([
            'support_name' => 'required|string|min:2|max:50',
            'support_surname' => 'required|string|min:2|max:50',
            'support_email' => 'required|email|max:100',
            'support_phone' => 'nullable',
            'where' => 'required|string',
            'what' => 'required|string',
            'support_message' => 'required|string|min:10|max:1000',
            'vop' => 'required|accepted'
        ], [
            'vop.accepted' => 'Musíte súhlasiť so spracovaním údajov.'
        ]);
        try {
            Support::create([
                'name' => $validated['support_name'] ?? null,
                'surname' => $validated['support_surname'] ?? null,
                'email' => $validated['support_email'] ?? null,
                'phone' => $validated['support_phone'] ?? null,
                'place_problem' => $validated['where'] ?? null,
                'what_problem' => $validated['what'] ?? null,
                'message' => $validated['support_message'] ?? null
            ]);

            return back()->with('message', 'Podnet bol úspešne odoslaný.');

        } catch (\Exception $e) {
            Log::error('Support form submission failed: ' . $e->getMessage());
            return back()->with('error', 'Nastala chyba pri odosielaní. Skúste to prosím neskôr.'.$e->getMessage());
        }
    }
}
