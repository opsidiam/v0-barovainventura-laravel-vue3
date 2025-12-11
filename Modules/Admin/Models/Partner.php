<?php

namespace Modules\Admin\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model {
    use SoftDeletes;
    protected $fillable = ['code','first_name','last_name','company','phone','email','notes'];
    public function users()       { return $this->hasMany(User::class); }
    public function commissions() { return $this->hasMany(PartnerCommission::class); }
    public function getFullNameAttribute(){ return trim("{$this->first_name} {$this->last_name}"); }
}
