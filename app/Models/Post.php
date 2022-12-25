<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $table = 'posts';
    public $timestamps = true;
    protected $fillable = array('title', 'image', 'content', 'category_id');

    public function getMyFavouritePosts()
    {
        $client = auth('client-api')->user();
        if(!$client){
            $client = auth('client-web')->user();
        }
        if($client){
            $check = $this->whereHas('clients',function($query) use($client){
                $query->where('clients.id',$client->id);
            })->find($this->id);
            if($check){
                return true;
            }
        }
        return false;
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function clients()
    {
        return $this->belongsToMany('App\Models\Client');
    }

}
