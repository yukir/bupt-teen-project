<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityDay extends Model
{
    protected $fillable = ['name','start_at','end_at'];
    
    //模型关联
    public function activities() {
        return $this->hasMany('App\Activity');
    }
    
     public function user() {
        return $this->belongsTo('App\User')->withDefault(function ($user) {
            $user->username = '[已删除]';
            $user->id = -1;
        });
    }
}
