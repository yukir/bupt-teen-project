<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityDay extends Model
{
    //模型关联
    public function activities() {
        return $this->hasMany('App\Activitiy');
    }
    
     public function user() {
        return $this->belongsTo('App\User')->withDefault(function ($user) {
            $user->username = '[已删除]';
        });
    }
}
