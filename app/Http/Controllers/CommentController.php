<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Activity;

class CommentController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Activity $activity)
    {
        //
    }
    
    public function update(Request $request, Comment $comment)
    {
        //
    }
    
    public function destroy(Comment $comment)
    {
        //
    }
}
