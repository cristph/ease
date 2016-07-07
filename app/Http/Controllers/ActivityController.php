<?php

namespace App\Http\Controllers;

use App\Activity;
//use Illuminate\Http\Request;
use App\User;
use App\userActivity;
use Request;
use DB;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\Session;

class ActivityController extends Controller
{
    //加入活动
    public function activityList(){
        $userEmail=Session::get('userEmail');
        $activityIds=DB::table('userActivity')->where('userEmail',$userEmail)->lists('activityId');
        $activities=DB::table('activity')->whereNotIn('id', $activityIds)->get();
        return view('activity.joinActivity',['activities'=>$activities]);
    }

    public function activityListRedirect(){
        return redirect('activity/join');
    }

    public function joinActivity($id){
        $userActivity['userEmail']=Session::get('userEmail');
        $userActivity['activityId']=$id;
        userActivity::create($userActivity);
        return redirect('activity');
    }

    //退出活动
    public function dropActivity($id){
        $userEmail=Session::get('userEmail');
        DB::table('userActivity')->where('activityId', $id)->where('userEmail',$userEmail)->delete();
        return redirect('activity');
    }


    //我参与的活动
    public function joinedActivityList(){
        $userEmail=Session::get('userEmail');
        $activityIds=DB::table('userActivity')->where('userEmail',$userEmail)->lists('activityId');
        $activities=DB::table('activity')->whereIn('id', $activityIds)->get();
        return view('activity.joinedActivity',['activities'=>$activities]);
    }

    public function joinedActivityListRedirect(){
        return redirect('activity');
    }


    //发布活动
    public function postActivity(){
        $activity=new Activity();
        $activity['theme']=Request::get('theme');
        $activity['startTime']=Request::get('startTime');
        $activity['endTime']=Request::get('endTime');
        $activity['content']=Request::get('content');
        if(Session::has('userEmail')){
            $posterEmail=Session::get('userEmail');
            $activity['posterEmail']=$posterEmail;
            $posterName=DB::table('user')->where('email',$posterEmail)->first()->nickname;
            $activity['posterName']=$posterName;
        }
        $activity->save();
        $id=$activity->id;
        return redirect('activity/detail/'.$id);
    }

    public function showActivityDetail($id){
        $activity=Activity::find($id);
        return view('activity.activityDetail',compact('activity'));
    }

    public function showActivityDetail_posted($id){
        $activity=Activity::find($id);
        return view('activity.activityDetail',compact('activity'))->with('sign','posted');
    }

    public function showActivityDetail_join($id){
        $activity=Activity::find($id);
        return view('activity.activityDetail',compact('activity'))->with('sign','join');
    }

    public function showActivityDetail_joined($id){
        $activity=Activity::find($id);
        return view('activity.activityDetail',compact('activity'))->with('sign','joined');
    }


    public function postPage(){
        return view('activity.postActivity');
    }

    public function postPageRedirect(){
        return redirect('activity/post');
    }


    //我发布的活动
    public function postedPage(){
        if(Session::has('userEmail')){
            $posterEmail=Session::get('userEmail');
            $activities=DB::table('activity')->where('posterEmail',$posterEmail)->get();
            return view('activity.postedActivity',['activities'=>$activities]);
        }
    }

    //我发布的活动
    public function postedPageRedirect(){
        return redirect('activity/posted');
    }


    //编辑活动
    public function editActivity($id){
        $activity=Activity::find($id);
        return view('activity.editActivity')->with('activity',$activity);
    }

    public function updateActivity(){
        $id=Request::get('id');
        $theme=Request::get('theme');
        $startTime=Request::get('startTime');
        $endTime=Request::get('endTime');
        $content=Request::get('content');
        DB::table('activity')
            ->where('id', $id)
            ->update(['theme' => $theme,'startTime'=>$startTime,'endTime'=>$endTime,'content'=>$content]);
        return redirect('activity/detail/'.$id);
    }


    //删除活动
    public function deleteActivity($id){
        DB::table('activity')->where('id', $id)->delete();
        return redirect('activity/posted');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
    public function show($id)
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
}