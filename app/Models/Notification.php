<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('title', 'content');

    public function donationRequest()
    {
        return $this->belongsTo('App\Models\DonationRequest');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client')->withPivot('is_read')->withTimestamps();
    }


    // public function getMyReadNotifications()
    // {
    //     $client = auth('client-api')->user();
    //     if(!$client){
    //         $client = auth('client-web')->user();
    //     }
    //     if($client){
    //         $check = $this->whereHas('donationRequest',function($query) use($client){
    //             $query->where('clients.id',$client->id);
    //         })->find($this->id);
    //         if($check){
    //             return true;
    //         }
    //     }
    //     return false;
    // }

}
