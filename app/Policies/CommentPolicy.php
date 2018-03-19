<?php

namespace App\Policies;

use App\User;
use App\Comment;
use App\Activity;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
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
     * Determine whether the user can view the comment.
     *
     * @param  \App\User  $user
     * @param  \App\Comment  $comment
     * @return mixed
     */
    public function view(User $user, Comment $comment, Activity $activity)
    {
        if (config("settings.public_comments") == 2) return true;
        if (config("settings.public_comments") == 1) return $activity->user_participated($user) || $activity->user_id == $user->id;
        
        return $activity->user_id == $user->id;
        
    }

    public function create(User $user, Activity $activity)
    {
        if (config("settings.comment_only_signed") && !$activity->user_participated($user)) return false;
        if (config("settings.comment_only_activity_ends")) return $activity->is_end();
        
        return true;
    }


    public function update(User $user, Comment $comment, Activity $activity)
    {
        if (config("settings.comment_modifiable")) return $comment->user_id = $user->id;
        return false;
    }
    
    //审核
    public function moderate(User $user, Comment $comment, Activity $activity)
    {
        return $this->isAdminOfType($user,$activity->type);
        
    }
    
    public function delete(User $user, Comment $comment, Activity $activity)
    {
        if ($this->isAdminOfType($user,$activity->type)) return true;
        if (config("settings.comment_modifiable")) return $comment->user_id = $user->id;
        return false;
    }
    
    public static function isAdminOfType(User $user,$type) {
        if ($user->sxyl_admin && $type == "sxyl") return true;
        if ($user->xxst_admin && ($type == "yxtx" || $type == "mzy")) return true;
        if (($user->zttr_admin || $user->zttr_tzs ) && $type == "zttr") return true;
            
        if ($user->zttr_tgpx && $type == "tgpx") return true;
        if ($user->xywh_admin && $type == "xywh") return true;
        
        return false;
    }
}
