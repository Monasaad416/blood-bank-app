<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model 
{

    protected $table = 'messages';
    public $timestamps = true;
    protected $fillable = array('title', 'content', 'client_id');

    public function client()
    {
        return $this->belongsTo('App\Models\Client');
    }

}