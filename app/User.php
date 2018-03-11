<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    //模型关联
    public function activities() {
        return $this->hasMany('App\Activitiy')
    }
    
    public function comments() {
        return $this->hasMany('App\Comment')
    }
    
    public function applications() {
        return $this->hasMany('App\Application')
    }
    
    public function community_days() {
        return $this->hasMany('App\CommunityDay')
    }
    
    //方法
    public function isSuperAdmin() {
        return $this->super_admin;
    }
    
    //权限部分待补充
}
