<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use App\CommunityDay;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CommunityDayController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth')->except(['index','show']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('viewList',\App\CommunityDay::Class);
        
        $community_days = CommunityDay::orderBy('created_at', 'desc')->take(30)->get();
        return view('community_day.list', [
            'main_title' => '主题团日列表',
            'community_days' => $community_days,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        
        $this->authorize('create',\App\CommunityDay::Class);
       
        return view('community_day.create', [
            'main_title' => '创建主题团日',
        ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
    
        //活动表单后端验证
        $validatedData = $request->validate([
            'name' => 'required|string|max:191|unique:community_days' ,
            'start_at' => 'nullable|date|after:yesterday',
            'end_at' => 'nullable|date|after:start_at',
        ]);

        //权限后端验证
        $this->authorize('create',\App\CommunityDay::Class);
            
        $cd = new CommunityDay($request->only(['name','start_at','end_at']));

        auth()->user()->community_days()->save($cd);
               
        return redirect()->route('community_day.show',[
            'community_day' => $cd->id,
        ])->with('info', '主题团日发布成功!');
        
    }


    public function show(CommunityDay $community_day)
    {
        $this->authorize('view',$community_day);
        
        return view('community_day.show', [
            'main_title' => $community_day->name,
            'community_day' => $community_day,
        ]);
    }


    public function edit(CommunityDay $community_day)
    {
        $this->authorize('update',$community_day);
        
        return view('community_day.update', [
            'main_title' => '编辑主题团日 - '.$community_day->name,
            'community_day' => $community_day,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommunityDay $community_day)
    {
        $this->authorize('update',$community_day);
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:191|unique:community_days' ,
            'start_at' => 'nullable|date|after:yesterday',
            'end_at' => 'nullable|date|after:start_at',
        ]);
        
        $community_day->fill($request->only(['name','start_at','end_at']));

        
        $community_day->save();
        
        return redirect()->route('community_day.show',[
            'community_day' => $community_day->id,
        ])->with('info', '主题团日修改成功!');
    }


    public function destroy(CommunityDay $community_day)
    {
        $this->authorize('delete',$community_day);
        
        //TODO 删除旗下活动
        
        $community_day->delete();
        
        return redirect()->action(
            'CommunityDayController@index'
        )->with('info', '主题团日删除成功!');;
    }
}
