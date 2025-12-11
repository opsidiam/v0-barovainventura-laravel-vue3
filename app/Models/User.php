<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Modules\Admin\Models\Note;
use Modules\Admin\Models\Partner;
use Modules\Admin\Models\PartnerCommission;
use Modules\Bar\Models\Bar;
use Modules\License\Models\License;
use Modules\License\Models\Order;
use Modules\User\Models\LoginHistory;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'invoice_phone',
        'password',
        'reference',
        'licence_expire',
        'licence_bar_count',
        'missing_mail_send',
        'last_seen_at',
        'partner_id'
    ];

    protected $casts = [
        'licence_expire' => 'datetime',
        'last_seen_at' => 'datetime',
        'device_loan_start_at'     => 'date',
        'device_loan_purchased_at' => 'datetime',
        'device_loan_returned_at'  => 'datetime',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function loginHistory()
    {
        return $this->hasMany(LoginHistory::class);
    }

    public function orderHistory()
    {
        return $this->hasMany(Order::class);
    }

    public function licence()
    {
        return $this->hasMany(License::class, 'category', 'licences_category');
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new CustomResetPasswordNotification($token));
    }

    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    public function bars()
    {
        return $this->hasMany(Bar::class);
    }

    public function files()
    {
        return $this->hasMany(UserFile::class);
    }

    public function notes() {
        return $this->morphMany(Note::class, 'notable')->latest();
    }

    public function partner() {
        return $this->belongsTo(Partner::class);
    }

    public function partnerCommissions() {
        return $this->hasMany(PartnerCommission::class);
    }
}
