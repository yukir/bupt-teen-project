<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    //模型关联
    public function user() {
        return $this->belongsTo('App\User')->withDefault(function ($user) {
            $user->username = '[已删除]';
        });
    }
    
    public function community_day() {
        return $this->belongsTo('App\CommunityDay')->withDefault(function ($day) {
            $day->name = '无';
        });
    }
    
    public function comments() {
        return $this->hasMany('App\Comment');
    }
    
    public function applications() {
        return $this->hasMany('App\Application');
    }

    public function timestamp_tokens() {
        return $this->hasMany('App\TimestampToken');
    }
}
