<?php

return [

    /*
    |--------------------------------------------------------------------------
    | 北邮青年 自定义设定(根据甲方要求改变)
    |--------------------------------------------------------------------------
    */
    
    /*-------------------------------------------------------------------------*\
    | 活动相关 
    \*-------------------------------------------------------------------------*/
    
    
    /*-------------------------------------------------------------------------*\
    | 评论/反馈相关 
    \*-------------------------------------------------------------------------*/
    
    //活动结束后才能提交反馈
    'comment_only_activity_ends' => 0,
    //参加活动者才可以提交反馈
    'comment_only_signed' => 1,
    //活动反馈公开给:所有用户2 参加活动的用户1 仅活动发布者0
    'public_comments' => 2,
    //评论是否需要审核
    'comment_moderation' => 0,


];
