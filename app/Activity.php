<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Carbon\Carbon;

class Activity extends Model
{
    
    protected $fillable = ['user_id','title','content','type','start_at','check_required','community_day_id'];
    
    //模型关联
    //这里指发布者
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
    
    //用户是否参加了该活动
    public function user_participated(User $user) {
        $applications = $user->application;
        
        foreach($applications as $app) if($app->activity->id = $this->id) return true;
        return false;
    }
    
    //活动是否结束
    public function is_end() {
        if ($this->start_at == null || empty($this->start_at)) return true;
        return $this->start_at > Carbon::now();
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
    
    
    //评论删除
    public function delete_comments() {
        $this->comments()->delete();
    }
}
