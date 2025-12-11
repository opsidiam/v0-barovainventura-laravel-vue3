<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Admin\Models\Partner;

class AdminPartnerController extends Controller
{
    public function index()
    {
        $partners = Partner::withCount([
            'users as users_count',
            'commissions as eligible_count' => fn($q)=>$q->where('status','eligible'),
            'commissions as paid_count'     => fn($q)=>$q->where('status','paid'),
        ])->paginate(20);

        return view('admin::partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin::partners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required','string','max:100'],
            'last_name'  => ['required','string','max:100'],
            'company'    => ['nullable','string','max:150'],
            'email'      => ['required','email','max:150','unique:partners,email'],
            'phone'      => ['nullable','string','max:40'],
            'commission' => ['nullable','numeric','min:0'],
            'note'       => ['nullable','string','max:1000'],
        ]);

        $data['code'] = base64_encode($request->first_name.$request->last_name);
        dd($data);
        Partner::create($data);
        return redirect()->route('admin.partners.index')->with('success', __('admin.saved_successfully'));

    }

    public function show($id)
    {
        $partner = Partner::findOrFail($id);

        $clients = User::where('partner_id', $partner->id)
            ->select([
                'id','name','email','created_at',
                'licence_expire', 'licences_category',
            ])
            ->with('partnerCommissions')
            ->latest('created_at')
            ->paginate(25);

        return view('admin::partners.show', compact('partner', 'clients'));
    }


    public function edit($id)
    {
        $partner = Partner::findOrFail($id);
        return view('admin::partners.edit', compact('partner'));
    }

    public function update(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);
        $data = $request->validate([
            'first_name' => ['required','string','max:80'],
            'last_name'  => ['required','string','max:80'],
            'company'    => ['nullable','string','max:120'],
            'phone'      => ['nullable','string','max:40'],
            'email'      => ['nullable','email','max:120'],
            'notes'      => ['nullable','string','max:2000'],
        ]);
        $partner->update($data);

        return redirect()->route('admin.partners.show', $partner)->with('success','Obchodník aktualizovaný.');
    }

    public function destroy($id)
    {
        Partner::findOrFail($id)->delete();
        return redirect()->route('admin.partners.index')->with('success','Obchodník zmazaný.');
    }
}
