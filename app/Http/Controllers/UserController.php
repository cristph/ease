<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
//use App\Http\Requests;
use App\authApply;
use App\User;
use Illuminate\Support\Facades\Redirect;
use Request;
use Input;
use DB;
use Session;
use Validator;
use Response;
use File;
//use App\Http\Controllers\Controller;

class UserController extends Controller
{

    //创建用户
    public function register(){

        $email=Request::get('email');
        $user=DB::table('user')->where('email','=',$email)->first();
        if($user){
            return redirect('register')->with('email_msg','该邮箱已被注册');
        }

        $input['email']=$email;
        $input['nickname']=Request::get('nickname');
        $input['password']=Request::get('post-password');
        $input['auth']=1;
        $input['avatar']=asset('uploads/noavatar.gif');
        User::create($input);

        return redirect('login');
    }

    public function registerView(){
        if(Session::has('email_msg')){
            return view('home.register')->with('email_msg','该邮箱已被注册');
        }
        return view('home.register');
    }

    public function registerValidate(){
        if(Request::ajax()){
            $email=Input::get('email');
            $user=DB::table('user')->where('email','=',$email)->first();
            if($user){
                $result['result']='fail';
                return $result;
            }else{
                $result['result']='success';
                return $result;
            }
        }
    }

    //用户登录
    public function login(){
        $email = Request::get('email');
        $user = DB::table('user')->where('email', '=', $email)->first();
        if(!$user){
            return redirect('login')->with('email_msg','该用户不存在')->withInput();
        }else{
            $input_pswd=Request::get('password');
            $pswd=$user->password;
            if($input_pswd==$pswd){
                Session::put('userEmail',$email);
                Session::put('userAuth',$user->auth);
                Session::put('userName',$user->nickname);
                Session::put('avatar',$user->avatar);
                Session::put('sex',$user->sex);
                return redirect('bbs');
            }else{
                return Redirect::back()->with('pswd_msg','密码输入错误')->withInput();
            }
        }
    }

    public function loginView(){
        if(Session::has('email_msg')){
            return view('home.login')->with('email_msg',Session::get('email_msg'));
        }
        if(Session::has('pswd_msg')){
            return view('home.login')->with('pswd_msg',Session::get('pswd_msg'));
        }
        return view('home.login');
    }

    public function logout(){
        if(Session::has('userEmail')){
            Session::flush();
        }
        return redirect('/login');
    }


    //用户设置
    public function settingView(){
        $userEmail=Session::get('userEmail');
        $user=DB::table('user')->where('email',$userEmail)->first();
        return view('user.setting')->with('user',$user);
    }

    public function  saveSetting(){
        $userEmail=Session::get('userEmail');
        $input=Request::all();
        DB::table('user')
            ->where('email', $userEmail)
            ->update([
                'nickname'=>$input['nickname'],
                'sex'=>$input['sex'],
                'area'=>$input['area'],
                'birthday'=>$input['birthday'],
                'selfintro'=>$input['selfintro'],
                'contact'=>$input['contact']
            ]);
        Session::put('userName',$input['nickname']);
        Session::put('sex',$input['sex']);
        return redirect('user/setting');
    }

    public function avatarView(){
        return view('user.avatar');
    }

    public function postAvatar(){
        $file = Input::file('image');
        $input = array('image' => $file);
        $rules = array(
            'image' => 'image'
        );
        $validator = Validator::make($input, $rules);
        if ( $validator->fails() ) {
            return Response::json([
                'success' => false,
                'errors' => $validator->getMessageBag()->toArray()
            ]);

        }

        $destinationPath = 'uploads/';
        $filename = $file->getClientOriginalName();

        $file->move($destinationPath, $filename);

        $pp=asset($destinationPath.$filename);
        $user=Session::get('userEmail');
        DB::table('user')->where('email',$user)->update(['avatar'=>$pp]);

        Session::put('avatar',$pp);

        return Response::json(
            [
                'success' => true,
                'avatar' => asset($destinationPath.$filename),
            ]
        );
    }

    public function wrongTokenAjax(){
        if ( Session::token() !== Request::get('_token') ) {
            $response = [
                'status' => false,
                'errors' => 'Wrong Token',
            ];

            return Response::json($response);
        }
    }

    public function resetPasswordView(){
        if(Session::has('msg1')){
            return view('user.resetpswd')->with('msg1',Session::get('msg1'));
        }
        if(Session::has('msg2')){
            return view('user.resetpswd')->with('msg2',Session::get('msg2'));
        }
        return view('user.resetpswd');
    }

    public function resetPassword(){
        $originPswd=Request::get('originPswd');
        $newPswd=Request::get('newPswd');
        $sureNewPswd=Request::get('sureNewPswd');

        $userEmail=Session::get('userEmail');
        $pswd=DB::table('user')->where('email',$userEmail)->first()->password;

        if($originPswd==$pswd){
            if($newPswd==$sureNewPswd){
                DB::table('user')->where('email',$userEmail)->update(['password'=>$newPswd]);
                return redirect('login');
            }else{
                return redirect('user/resetpswd')->withInput()->with('msg2','前后两次输入的密码不一致');
            }
        }else{
            return redirect('user/resetpswd')->withInput()->with('msg1','原密码输入有误');
        }
    }

    public function settingViewRedirect(){
        return redirect('user/setting');
    }

    public function resetPasswordViewRedirect(){
        return redirect('user/resetpswd');
    }

    public function avatarViewRedirect(){
        return redirect('user/setavatar');
    }

    public function authView(){
        $auth=Session::get('userAuth');
        if($auth==4){
            $applies=DB::table('authapply')->get();
            return view('user.authmanage',['applies'=>$applies]);
        }else{
            $userEmail=Session::get('userEmail');
            $apply=DB::table('authapply')->where('applyerEmail',$userEmail)->first();
            if($apply){
                //提出过申请
//                return view('user.authmanage',compact('apply'))->with('msg','1');
//                return $apply->applyerEmail;
                return view('user.authmanage')->with('apply',$apply);
            }else{
                //未提出申请或者是提出申请已经被通过
                return view('user.authmanage');
            }
        }
    }

    public function authRedirect(){
        return redirect('user/authmanage');
    }


    //申请权限
    public function getAuth(){
        $input['applyerAuth']=Request::get('auth');
        $userEmail=Session::get('userEmail');
        $input['applyerEmail']=$userEmail;
        $name=DB::table('user')->where('email',$userEmail)->first()->nickname;
        $input['applyerName']=$name;
        authApply::create($input);
        return redirect('user/authmanage');
    }

    //
    public function agreeAuth($id){
        $apply=DB::table('authapply')->where('id',$id)->first();
        DB::table('user')->where('email',$apply->applyerEmail)->update(['auth'=>$apply->applyerAuth]);
        DB::table('authapply')->where('id',$id)->delete();
        return redirect('user/authmanage');
    }

    public function disagreeAuth($id){
        DB::table('authapply')->where('id',$id)->delete();
        return redirect('user/authmanage');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {

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
