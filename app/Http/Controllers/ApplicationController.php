<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Activity;
use App\Application;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($activityID)
    {
        $applications = Application::all()->where('activity_id', $activityID);
        return $applications;
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
        //
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
     *
     * @param  int  $activityID
     * @param  int  $applicationID
     * @return \Illuminate\Http\Response
     */
    public function signIn($activityID, $applicationID) {
        $application = Application::find($applicationID);
        $application->sign_in = 1;
        $application->save();
        return 1;
    }

    /**
     * Turn the 'sign_out' coloum of $applicationID to 1.
     *
     * @param  int  $activityID
     * @param  int  $applicationID
     * @return \Illuminate\Http\Response
     */
    public function signOut($activityID, $applicationID) {
        $application = Application::find($applicationID);
        $application->sign_out = 1;
        $application->save();
        return 1;
    }
}
