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
        if ($user->isSuperAdmin()) {
            return true;
        }

    }
    
    /**
     * Determine whether the user can view the activity.
     *
     * @param  \App\User  $user
     * @param  \App\Activity  $activity
     * @return mixed
     */
    public function view(User $user, Activity $activity)
    {
        
        //
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

        if ($user->sxyl_admin && $type->type == "sxyl") return true;
        if ($user->xxst_admin && ($type->type == "yxtx" || $type->type == "mzy")) return true;
        if (($user->zttr_admin || $user->zttr_tzs ) && $type->type == "zttr") return true;
            
        if ($user->zttr_tgpx && $type->type == "tgpx") return true;
        if ($user->xywh_admin && $type->type == "xywh") return true;
        
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
