<?php

namespace App\Http\Controllers;

use App\Activity;
use App\User;
use App\CommunityDay;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ActivityController extends Controller
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
        if(!$request->has('type')) abort(400);
        
        $type = $request->input('type');
        $this->authorize('viewList',[\App\Activity::Class,$type]);
        
        $activities = Activity::where('type',$type)->orderBy('created_at', 'desc')->take(30)->get();
        
        $extended_nav = $type == 'zttr' ? 2 : 1;
        
        return view('activity.list', [
            'main_title' => Activity::type_name($type).'活动列表',
            'extended_nav' => $extended_nav,
            'type' => $request->input('type'),
            'activities' => $activities,
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(!$request->has('type')) abort(400,'缺少参数！');
        
        $type = $request->input('type');
        
        $this->authorize('createWithType',[\App\Activity::Class,$request->input('type')]);
        
        $community_day_id = null;
        $extended_nav = $type == 'zttr' ? 1 : 2;
        
        if ($type == 'zttr') {
            //创建的是主题团日活动
            if (!$request->has('community_day_id')) abort(400,'缺少参数！');
            $community_day_id = $request->input('community_day_id');
            $this->authorize('createActivity',CommunityDay::find($community_day_id));
        }
       
        return view('activity.create', [
            'main_title' => Activity::type_name($type).'活动 - 创建',
            'community_day_id' => $community_day_id,
            'extended_nav' => $extended_nav ,
            'type' => $type,
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
            'title' => 'required|string|max:191|unique:activities' ,
            'type' => [
                'required',
                Rule::in(['sxyl','yxtx','mzy','zttr','tgpx', 'xywh'])
            ],
            'content' => 'required|max:65535',
            'start_at' => 'nullable|date|after:yesterday',
            'community_day_id' => 'nullable|numeric',
        ]);

        //权限后端验证
        $this->authorize('createWithType',[\App\Activity::Class,$request->input('type')]);
            
        if ($request->input('type') == 'zttr') {
            //创建的是主题团日活动
            if (!$request->has('community_day_id')) abort(400,'缺少参数！');
            $community_day_id = $request->input('community_day_id');
            $this->authorize('createActivity',CommunityDay::find($community_day_id));
        } else {
            if ($request->has('community_day_id')) dd(1);
        }
        $a = new Activity($request->only(['title','content','type','start_at','community_day_id']));
        if ($request->has("check_required") && $request->input("check_required")=="on") $a->check_required = 1;
        auth()->user()->activities()->save($a);
               
        return redirect()->route('activity.show',[
            'activity' => $a->id,
        ])->with('info', '活动发布成功!');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(Activity $activity)
    {
        $this->authorize('view',$activity);
        
        return view('activity.show', [
            'main_title' => $activity->title,
            'extended_nav' => 1,
            'type' => $activity->type,
            'activity' => $activity,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        $this->authorize('update',$activity);
        
        return view('activity.update', [
            'main_title' => '编辑活动 - '.$activity->title,
            'extended_nav' => 1,
            'type' => $activity->type,
            'activity' => $activity,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Activity $activity)
    {
        $this->authorize('update',$activity);
        
        $validatedData = $request->validate([
            'title' => 'required|string|max:191' ,
            'type' => [
                'required',
                Rule::in(['sxyl','yxtx','mzy','zttr','tgpx', 'xywh'])
            ],
            'content' => 'required|max:65535',
            'start_at' => 'nullable|date|after:yesterday',
            'community_day_id' => 'nullable|numeric',
        ]);
        
        $activity->fill($request->only(['title','content','type','start_at','community_day_id']));
        if ($request->has("check_required") && $request->input("check_required")=="on") $activity->check_required = 1;
        
        $activity->save();
        
        return redirect()->route('activity.show',[
            'activity' => $activity->id,
        ])->with('info', '活动修改成功!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $this->authorize('delete',$activity);
        
        $type = $activity->type;
        
        $activity->delete_comments();
        $activity->delete();
        
        return redirect()->action(
            'ActivityController@index', ['type' => $type]
        )->with('info', '活动删除成功!');;
    }
}
