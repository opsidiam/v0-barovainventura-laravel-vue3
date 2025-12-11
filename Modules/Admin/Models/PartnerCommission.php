<?php

namespace Modules\Admin\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class PartnerCommission extends Model
{
    protected $fillable = ['partner_id', 'user_id', 'amount', 'status', 'eligible_at', 'paid_at', 'paid_note'];
    protected $casts = [
        'paid_at' => 'datetime'
    ];

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
