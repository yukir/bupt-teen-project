<?php

namespace App\Policies;

use App\User;
use App\Application;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the application.
     *
     * @param  \App\User  $user
     * @param  \App\Application  $application
     * @return mixed
     */
    public function view(User $user, Application $application)
    {
        //
    }

    /**
     * Determine whether the user can create applications.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }
    
    /**
     * 用户是否有处理申请表的权利
     * 当前策略是仅活动组织者可以批准、签到、签退活动的申请表
     */
    public function update(User $user, Application $application) 
    {
        return $user->id === $application->user_id;
    }

    /**
     * Determine whether the user can delete the application.
     *
     * @param  \App\User  $user
     * @param  \App\Application  $application
     * @return mixed
     */
    public function delete(User $user, Application $application)
    {
        //
    }
}
