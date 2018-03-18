<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name','admin_id','private_chat'];

    public function groupAdmin(){
        return $this->belongsTo('App\User','admin_id');
    }

    public function subscribers(){
        return $this->belongsToMany('App\User');
    }
    public function  messages(){
        return $this->hasMany('App\Message');
    }
}
