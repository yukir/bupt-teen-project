<?php

namespace App\Policies;

use App\User;
use App\Activity;
use App\CommunityDay;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommunityDayPolicy
{
    use HandlesAuthorization;
    
    public function before($user, $ability)
    {
        if ($user->isSuperAdmin()) 
            return true;
        
        if ($user->banned) 
            return false;

    }
    

    public function view(User $user,CommunityDay $community_day)
    {
        return true;
    }
    

    public function viewList(User $user)
    {
        return true;
    }

    public function create(User $user)
    {
        return $this->isCommunityAdmin($user);
    }
    public function createActivity(User $user,CommunityDay $community_day)
    {
        return $user->id == $community_day->user->id;
    }

    public function update(User $user,CommunityDay $community_day)
    {
        return $user->id == $community_day->user->id;
        
    }
    public function delete(User $user,CommunityDay $community_day)
    {
        return $user->id == $community_day->user->id;
    }
    
    public static function isCommunityAdmin(User $user) {
        
        return $user->zttr_xtw || $user->zttr_tzs;
    }
}
