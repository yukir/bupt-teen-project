<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    
    protected $fillable = ['title','content','type','start_at','check_required','community_day_id'];
    
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
    
    //类型翻译
    public static function type_name($str) {
        $strArr = [
            "sxyl" => "思想引领",  
            "yxtx" => "雁翔团校",  
            "mzy"  => "梦之翼",  
            "zttr" => "主题团日",  
            "tgpx" => "团干培训",  
            "xywh" => "校园文化",  
        ];
        if (array_key_exists($str,$strArr)) return $strArr[$str];
        return $str;
    }
}
