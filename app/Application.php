<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    //模型关联
    public function user() {
        return $this->belongsTo('App\User')->withDefault(function ($user) {
            $user->username = '[已删除]';
        });
    }
    
    public function activity() {
        return $this->belongsTo('App\Activity');
    }
}
