<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //模型关联
    
    //这里指发布的活动
    public function activities() { 
        return $this->hasMany('App\Activity');
    }
    
    public function comments() {
        return $this->hasMany('App\Comment');
    }
    
    public function applications() {
        return $this->hasMany('App\Application');
    }
    
    public function community_days() {
        return $this->hasMany('App\CommunityDay');
    }
    
    
    /**
     * 方法
     */
    
    //超级管理员 拥有一切权限
    public function isSuperAdmin() {
        return $this->super_admin;
    }
    
    //是否参加了某项活动
    public function isParticipating(Activity $activity) {
        $applications = $activity->application;
        
        foreach($applications as $app) if($app->user->id = $this->id) return true;
        return false;
    }
    
    //拥有团员信息管理权限 
    
    //列出权限
    public function powerShown() {
        if ($this->banned) return "被封禁用户，权限有限。";
            
        $str = "拥有基础权限";

        if ($this->sxyl_admin) $str.="、思想引领-主题教育";
        if ($this->xxst_admin) $str.="、思想引领-学习社团";
        if ($this->zttr_xtw) $str.="、基层团建-主题团日校团委";
        if ($this->zttr_tzs) $str.="、基层团建-主题团日团支书";
        if ($this->zttr_tgpx) $str.="、基层团建-团干培训";
        if ($this->zttr_admin) $str.="、基层团建上级团组织";
        if ($this->xywh_admin) $str.="、校园文化";
        $str .= "相关权限。";
        
        return $str;
    }
    //权限部分待补充
}
