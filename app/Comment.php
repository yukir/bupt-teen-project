<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id','activity_id','content','checked'];
    
    //模型关联
    public function user() {
        return $this->belongsTo('App\User')->withDefault(function ($user) {
            $user->username = '[已删除]';
            $user->id = -1;
        });
    }
    
    public function activity() {
        return $this->belongsTo('App\Activity');
    }
}
