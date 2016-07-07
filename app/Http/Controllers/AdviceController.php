<?php

namespace App\Http\Controllers;

use App\Advice;
use App\AdviceApply;
//use Illuminate\Http\Request;
//use App\Http\Requests;

use Request;
use DB;

use App\Http\Controllers\Controller;
//use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AdviceController extends Controller
{

    public function authLogin(){
        $auth=Session::get('userAuth');
        if($auth==2||$auth==3){
            $applies=DB::table('adviceapply')->where('adviserEmail',Session::get('userEmail'))->get();
            return view('advice.adviser',['applies'=>$applies]);
        }else{
            $list=DB::table('adviceapply')->where('userEmail',Session::get('userEmail'))->lists('adviserEmail');
            $doctors=DB::table('user')->where('auth',2)->whereNotIn('email',$list)->get();
            $coaches=DB::table('user')->where('auth',3)->whereNotIn('email',$list)->get();
            return view('advice.user',['doctors'=>$doctors,'coaches'=>$coaches]);
        }
    }

    public function userView(){
        $list=DB::table('adviceapply')->where('userEmail',Session::get('userEmail'))->lists('adviserEmail');
        $doctors=DB::table('user')->where('auth',2)->whereNotIn('email',$list)->get();
        $coaches=DB::table('user')->where('auth',3)->whereNotIn('email',$list)->get();
        return view('advice.user',['doctors'=>$doctors,'coaches'=>$coaches]);
    }

    public function requsetAdvice($email){
        $apply['userEmail']=Session::get('userEmail');
        $apply['userName']=Session::get('userName');
        $apply['adviserEmail']=$email;
        $adviser=DB::table('user')->where('email',$email)->first();
        $apply['adviserName']=$adviser->nickname;
        $apply['adviserType']=$adviser->auth;
        AdviceApply::create($apply);
        return redirect('advice/user');
    }

    public function adviserView(){
        $applies=DB::table('adviceapply')->where('adviserEmail',Session::get('userEmail'))->get();

        return view('advice.adviser',['applies'=>$applies]);
    }

    public function postAdvice(){
        $id=Request::get('id');
        $apply=DB::table('adviceapply')->where('id',$id)->first();
        $input['content']=Request::get('content');
        $input['userEmail']=$apply->userEmail;
        $input['userName']=$apply->userName;
        $input['adviserEmail']=$apply->adviserEmail;
        $input['adviserName']=$apply->adviserName;
        $input['adviserType']=$apply->adviserType;

        Advice::create($input);
        DB::table('adviceapply')->where('id',$id)->delete();

        return redirect('/advice/adviser');
    }

    public function deleteAdvice($id){
        DB::table('advice')->where('id',$id)->delete();
        $auth=Session::get('userAuth');
        if($auth==1){
            return redirect('/advice/receiveAdvice');
        }else{
            return redirect('/advice/postAdvice');
        }
    }

    public  function  receiveAdviceView(){
        $user=Session::get('userEmail');
        $advices=DB::table('advice')->where('userEmail',$user)->get();
        return view('advice.receiveAdvice',['advices'=>$advices]);
    }

    public  function  postAdviceView(){
        $user=Session::get('userEmail');
        $advices=DB::table('advice')->where('adviserEmail',$user)->get();
        return view('advice.postAdvice',['advices'=>$advices]);
    }

    public function userViewRedirect(){
        return redirect('/advice/user');
    }

    public function adviserViewRedirect(){
        return redirect('/advice/adviser');
    }

    public  function  receiveAdviceViewRedirect(){
        return redirect('/advice/receiveAdvice');
    }

    public  function  postAdviceViewRedirect(){
        return redirect('/advice/postAdvice');
    }

    public function adviceRequestList(){
        $user=Session::get('userEmail');
        $applies=DB::table('adviceapply')->where('userEmail', $user)->get();
        return view('advice.adviceRequest',['applies'=>$applies]);
    }

    public function adviceRequestListRedirect(){
        return redirect('/advice/request');
    }

    public function deleteApply($id){
        DB::table('adviceapply')->where('id',$id)->delete();
        return redirect('/advice/request');
    }

}
