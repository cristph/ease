<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Session;
use Request;
use Input;
use DOMDocument;
use DB;

class HealthController extends Controller
{
    public function  loadData(){
        return view('health.loadXml');
    }

    public function loadXml(Request $request){
        if($request->hasFile('uploadFile')){

            $file = $request->file('uploadFile');

            $destinationPath = '/xmls/';
            $filename = $file->getClientOriginalName();

            $file->move($destinationPath, $filename);

            $xml = new DOMDocument();
            $xml->load($destinationPath. $filename);
            $postDom = $xml->getElementsByTagName("dataItem");

            $count=0;

            $email=Session::get('userEmail');

//            return $email;

            DB::statement('begin transaction;');
            foreach($postDom as $post){
                $rate = $post->getElementsByTagName("rate")->item(0)->nodeValue;
                $date = $post->getElementsByTagName("date")->item(0)->nodeValue;

                $sql="insert into healthheartdata(userEmail,date,rate) values( '" .$email. "','". $date. "',".$rate.');';
                DB::statement($sql);

                $count++;
                if($count%1000==0){
                    DB::statement('commit transaction;');
                    DB::statement('begin transaction;');
                }
            }
            DB::statement('commit transaction;');
            return '1';
        }
    }

    public function healthData(){
        if(Request::ajax()){
            $email=Input::get('email');
            $users=DB::table('healthheartdata')->where('userEmail','=',$email)->get();
            if($users){
//                return json_encode($users);
                return $users;
            }else{
                $result['result']='success';
                return $result;
            }
        }

//        if(Request::ajax()){
//            $email=Input::get('email');
//            $user=DB::table('user')->where('email','=',$email)->first();
//            if($user){
//                $result['result']='fail';
//                return $result;
//            }else{
//                $result['result']='success';
//                return $result;
//            }
//        }
    }
}
