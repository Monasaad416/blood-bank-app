<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'date_of_birth', 'last_donation_date',  'blood_type_id',  'city_id', 'phone', 'password', 'pin_code');

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function notifications()
    {
        return $this->belongsToMany('App\Models\Notification')->withPivot('is_read')->withTimestamps();
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Message');
    }

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post')->withTimestamps();
    }

    public function governorates()
    {
        return $this->belongsToMany('App\Models\Governorate')->withTimestamps();
    }

    public function donationBloodTypes()
    {
        return $this->belongsToMany('App\Models\BloodType')->withTimestamps();
    }


    public function notificationTokens()
    {
        return $this->hasMany('App\Models\NotificationToken');
    }


    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'roles_name' => 'array',
    ];
}
