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
     * 批准、签到、签退信息更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Application $application)
    {
        $this->authorize('update', $application);
        if ($request->has('status')) {
            $application->status = $request->status;
        }
        if ($request->has('sign_in')) {
            $application->sign_in = $request->sign_in;
        }
        if ($request->has('sign_out')) {
            $application->sign_out = $request->sign_out;
        }
        $application->save();
        return response()->json([
            'status' => $application->status,
            'sign_in' => $application->sign_in,
            'sign_out' => $application->sign_out
        ]);
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
     * 从 Web 访问时，可以为组织者展示签到用的二维码。
     *
     * @return \Illuminate\Http\Response
     */
    public function displaySignInQR(Activity $activity) {
        return view('activity.application.qr', [
            'activity' => $activity
        ]);
    }

    /**
     * Turn the 'sign_out' coloum of $applicationID to 1.
     * 从 Web 访问时，可以为参与者展示签到用的二维码。
     *
     * @return \Illuminate\Http\Response
     */
    public function displaySignOutQR(Request $request, Application $application) {
        return "请让组织者扫描此二维码来签退";
    }

    /**
     * 从 Web 访问时，可以为参与者展示签到用的二维码。
     *
     * @return \Illuminate\Http\Response
     */
    public function signIn(Request $request, Application $application) {
        return view('activity.application.qr', [
            'application' => $application
        ]);
    }

    /**
     * Turn the 'sign_out' coloum of $applicationID to 1.
     * 从 Web 访问时，可以为参与者展示签到用的二维码。
     *
     * @return \Illuminate\Http\Response
     */
    public function signOut(Request $request, Application $application) {
        return "请让组织者扫描此二维码来签退";
    }

    /**
     * Return an URL to sign in. 只允许 AJAX 访问。
    */
    public function signInURL(Activity $activity) {
        $activity->timestamp_tokens()->delete();
        $token = new TimestampToken();
        $token->id = rand();
        $token->activity()->associate($activity);
        $token->save();
        return route('application.signInWithToken', [
            'activity' => $activity,
            'token' => $token->id
        ]);
    }

    /**
     * Return an URL to sign out. 只允许 AJAX 访问。
    */
    public function signOutURL(Activity $activity) {
        $activity->timestamp_tokens()->delete();
        $token = new TimestampToken();
        $token->id = rand();
        $token->activity()->associate($activity);
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
