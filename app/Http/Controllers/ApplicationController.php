<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Application;
use App\TimestampToken;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Activity $activity)
    {
        $applications = $activity->applications;
        return view('activity.application.list', [
            'title' => '管理申请表',
            'applications' => $applications
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($activityID)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($activityId, $applicationID)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return response()->json(true);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Turn the 'sign_in' coloum of $applicationID to 1.
     * 从 Web 访问时，可以为参与者展示签到用的二维码。
     * 使用 AJAX 访问时，会返回操作结果。只有组织者有权限从 AJAX 访问。
     *
     * @return \Illuminate\Http\Response
     */
    public function signIn(Request $request, Application $application) {
        if($request->ajax()){
            $application->sign_in = 1;
            $application->save();
            return response()->json(true);
        }
        
        return "请让组织者扫描此二维码来签到";
    }

    /**
     * Turn the 'sign_out' coloum of $applicationID to 1.
     * 从 Web 访问时，可以为参与者和组织者分别展示签到用的二维码。
     * 使用 AJAX 访问时，会返回操作结果。
     *
     * @return \Illuminate\Http\Response
     */
    public function signOut(Request $request, Application $application) {
        if($request->ajax()){
            $application->sign_out = 1;
            $application->save();
            return response()->json(true);
        }
        
        return "请让组织者扫描此二维码来签退";
    }

    /**
     * Return an URL to sign in. 只允许 AJAX 访问。
    */
    public function signInURL(Application $application) {
        $token = new TimestampToken();
        $token->id = rand();
        $token->activity_id = $application->activity_id;
        $token->save();
        return route('application.signInWithToken', [
            'application' => $application,
            'token' => $token->id
        ]);
    }

    /**
     * Return an URL to sign out. 只允许 AJAX 访问。
    */
    public function signOutURL(Application $application) {
        $token = new TimestampToken();
        $token->id = rand();
        $token->activity_id = $application->activity_id;
        $token->save();
        return route('application.signOutWithToken', [
            'application' => $application,
            'token' => $token->id
        ]);
    }

    /**
     * 扫码签到。
     * 只有参与者会从 Web 访问这个页面。
    */
    public function signInWithToken(Application $application, $tokenID) {
        $token = TimestampToken::find($tokenID);
        if ($token == null) {
            return "Failed2";
        }
        if ($token->created_at->diffInSeconds() > 10) {
            $token->delete();
            return "Failed";
        } else {
            $application->sign_in = 1;
            $application->save();
            return "🐱";
        }
    }

    /**
     * 扫码签退。
     * 只有参与者会从 Web 访问这个页面。
    */
    public function signOutWithToken(Application $application, $tokenID) {
        $token = TimestampToken::find($tokenID);
        if ($token == null) {
            return "Failed2";
        }
        if ($token->created_at->diffInSeconds() > 10) {
            $token->delete();
            return "Failed";
        } else {
            $application->sign_out = 1;
            $application->save();
            return "🐱";
        }
    }
}
