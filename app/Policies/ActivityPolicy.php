<?php

namespace App\Policies;

use App\User;
use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\HandlesAuthorization;

class ActivityPolicy
{
    use HandlesAuthorization;
    
    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) 
            return true;
        
        if ($user->banned) 
            return false;

    }
    
    /**
     * 用户是否拥有浏览某个活动的权利
     * 需求待应答
     */
    public function view(User $user, Activity $activity)
    {
        return true;
    }
    
    /**
     * 用户是否拥有浏览某类活动列表的权利
     * 需求待应答
     */
    public function viewList(User $user, $type)
    {
        return true;
    }
    /**
     * 用户是否有创建活动的权利
     * 需求待应答
     */
    public function create(User $user,Type $type)
    {
        return true;
    }
    public function createWithType(User $user,$type)
    {

        if ($user->sxyl_admin && $type == "sxyl") return true;
        if ($user->xxst_admin && ($type == "yxtx" || $type == "mzy")) return true;
        if (($user->zttr_admin || $user->zttr_tzs ) && $type == "zttr") return true;
            
        if ($user->zttr_tgpx && $type == "tgpx") return true;
        if ($user->xywh_admin && $type == "xywh") return true;
        
        return false;
    }

    /**
     * 用户是否有编辑活动的权利
     * 需求待应答:是否必须为创建者才能修改？
     */
    public function update(User $user,Activity $activity)
    {

        return true;
        //return $user->id == $activity->user_id;
    }

    /**
     * 用户是否有创建活动的权利
     * 需求待应答:是否必须为创建者才能修改？
     */
    public function delete(User $user, Activity $activity)
    {
        return $user->id == $activity->user_id;
    }
}
