<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\moment;
use Request;
use DB;
use Session;


class BBSController extends Controller
{
    //用户登陆后首页

    public function  postmoment(){
        $input['content']=Request::get('content');
        $input['posterEmail']=Session::get('userEmail');
        $input['posterName']=Session::get('userName');

        moment::create($input);
        return redirect('/bbs');
    }


    public function bbsView(){
        $moments=DB::table('moment')->where('posterEmail',Session::get('userEmail'))->get();
        return view('bbs.bbs',['moments'=>$moments]);
    }
}
