<?php

namespace Modules\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Admin\Models\Partner;
use Modules\Admin\Models\PartnerCommission;

class AdminUserPartnerController extends Controller
{
    public function store(Request $request, User $user)
    {
        $data = $request->validate([
            'partner_id' => ['required','exists:partners,id'],
        ]);

        $user->update(['partner_id' => $data['partner_id']]);

        PartnerCommission::firstOrCreate(
            ['partner_id' => $data['partner_id'], 'user_id' => $user->id],
            ['amount' => 20.00, 'status' => 'pending']
        );

        return back()->with('success','Obchodník priradený a provízia založená (pending).');
    }

    // odpojenie
    public function destroy(User $user)
    {
        $user->update(['partner_id' => null]);
        return back()->with('success','Obchodník bol odpojený od používateľa.');
    }

    public function pay(PartnerCommission $commission, Request $request)
    {
        $commission->update([
            'status'   => 'paid',
            'paid_at'  => now(),
            'paid_note'=> $request->input('paid_note'),
        ]);
        return back()->with('success','Provízia bola označená ako vyplatená.');
    }

    public function markClientPayout(Partner $partner, User $user)
    {
        abort_unless($user->partner_id === $partner->id, 403);
        $partnerCommission = PartnerCommission::where([['partner_id' , $partner->id],['user_id' , $user->id]])->first();
        $partnerCommission->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return back()->with('success', __('admin.messages.success.partner_client_marked_paid'));
    }
}
