<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Activity;

class CommentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Activity $activity)
    {
        $this->authorize('create',$activity);
        
        $validatedData = $request->validate([
            'content' => 'required|max:191',
        ]);
        
        $c = new Comment;
        $c->content = $request->input('content');
        $c->checked = !config('settings.comment_moderation');
        $c->user_id = auth()->user()->id;
        
        $activity->comments()->save($c);
        
        return response()->json([
            'status' => 'success',
            'info' => '评论发布成功',
        ]);

    }
    
    public function update(Request $request, Comment $comment)
    {
        $activity = $comment->activity;
        
        $this->authorize('update',[$comment,$activity]);
        
        $validatedData = $request->validate([
            'content' => 'required|max:65535',
        ]);
        
        $comment->content = $request->input('content');
        
        $comment->save();
        
        return response()->json([
            'status' => 'success',
            'info' => '评论更新成功',
        ]);
    }
    
    public function destroy(Comment $comment)
    {
        $activity = $comment->activity;
        
        $this->authorize('delete',[$comment,$activity]);
        
        $comment->delete();
        
        return response()->json([
            'status' => 'success',
            'info' => '评论删除成功',
        ]);
    }
}
