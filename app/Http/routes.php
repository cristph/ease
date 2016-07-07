<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('about','PagesController@about');

Route::get('contact','PagesController@contact');

//Route::get('articles','ArticlesController@index');
//
//Route::get('articles/create','ArticlesController@create');
//
//Route::get('articles/{id}','ArticlesController@show');
//
//Route::post('articles', 'ArticlesController@store');
//
//Route::get('articles/{id}/edit', 'ArticlesController@edit');

//Route::resource('articles','ArticlesController');

/*************home***************/
Route::get('home','LoginController@home');

Route::get('login','UserController@loginView');

Route::post('/login/post','UserController@login');

Route::get('register','UserController@registerView');

Route::post('/register/validate','UserController@registerValidate');

Route::post('/register/post','UserController@register');

Route::get('/logout','UserController@logout');



/**************health**************/
Route::get('/health/loadData','HealthController@loadData');
Route::get('/health/loadXml','HealthController@loadXml');

Route::post('/health/getdata','HealthController@healthData');



Route::get('/health',function(){
    return view('health.manage');
});

Route::get('/health/exercise',function(){
    return view('health.exercise');
});

Route::get('/health/sleep',function(){
    return view('health.sleep');
});


/**********bbs************/
Route::post('/bbs/postmoment','BBSController@postmoment');

Route::get('/bbs','BBSController@bbsview');

//Route::get('bbs',function(){
//    return view('bbs.bbs');
//});

Route::get('bbs/collection',function(){
    return view('bbs.collection');
});

Route::get('bbs/message',function(){
    return view('bbs.message');
});

Route::get('bbs/star',function(){
    return view('bbs.star');
});

/*********Activity************/
//加入活动
Route::get('activity/join','ActivityController@activityList');
Route::get('joinactivityredirect','ActivityController@activityListRedirect');
Route::get('activity/join/{id}','ActivityController@joinActivity');

//退出活动
Route::get('activity/drop/{id}','ActivityController@dropActivity');

//我参与的活动
Route::get('activity','ActivityController@joinedActivityList');
Route::get('activityredirect','ActivityController@joinedActivityListRedirect');

//创建活动表单提交
Route::post('activity/formPost','ActivityController@postActivity');

//显示活动详情
Route::get('activity/detail/{id}','ActivityController@showActivityDetail');
Route::get('activity/detail_posted/{id}','ActivityController@showActivityDetail_posted');
Route::get('activity/detail_join/{id}','ActivityController@showActivityDetail_join');
Route::get('activity/detail_joined/{id}','ActivityController@showActivityDetail_joined');

//发布活动
Route::get('activity/post','ActivityController@postPage');
Route::get('activity/postredirect','ActivityController@postPageRedirect');

//我发布的活动
Route::get('activity/posted','ActivityController@postedPage');
Route::get('activity/postedredirect','ActivityController@postedPageRedirect');

//编辑活动
Route::get('activity/edit/{id}','ActivityController@editActivity');
Route::post('activity/update','ActivityController@updateActivity');

//删除活动
Route::get('activity/delete/{id}','ActivityController@deleteActivity');

/************Setting*************/
Route::get('/user/setting','UserController@settingView');

Route::post('/user/savesetting','UserController@saveSetting');

Route::get('/user/setavatar','UserController@avatarView');

Route::post('/user/avatar', 'UserController@postAvatar');

Route::get('/avatar/{id}/{size}', 'UserController@getAvatar');

//重设密码
Route::get('/user/resetpswd','UserController@resetPasswordView');

Route::post('/user/resetpswd','UserController@resetPassword');

Route::get('/user/settingredirect','UserController@settingViewRedirect');
Route::get('/user/resetpswdredirect','UserController@resetPasswordViewRedirect');
Route::get('/user/setavatarredirect','UserController@avatarViewRedirect');

//权限管理
Route::get('/user/authdredirect','UserController@authRedirect');

Route::get('/user/authmanage','UserController@authView');

Route::post('/user/getauth','UserController@getAuth');

Route::get('/user/agreeauth/{id}','UserController@agreeAuth');
Route::get('/user/disagreeauth/{id}','UserController@disagreeAuth');


/********************advice********************/
Route::get('/advice','AdviceController@authLogin');

Route::get('/advice/user','AdviceController@userView');
Route::get('/advice/adviser','AdviceController@adviserView');

Route::get('/advice/userredirect','AdviceController@userViewRedirect');
Route::get('/advice/adviserredirect','AdviceController@adviserViewRedirect');

Route::get('/advice/receiveAdvice','AdviceController@receiveAdviceView');
Route::get('/advice/postAdvice','AdviceController@postAdviceView');

Route::get('/advice/receiveAdviceredirect','AdviceController@receiveAdviceViewRedirect');
Route::get('/advice/postAdviceredirect','AdviceController@postAdviceViewRedirect');

Route::get('/advice/get/{email}','AdviceController@requsetAdvice');

Route::post('/advice/post','AdviceController@postAdvice');
Route::get('/advice/delete/{id}','AdviceController@deleteAdvice');

Route::get('/advice/request','AdviceController@adviceRequestList');
Route::get('/advice/requestredirect','AdviceController@adviceRequestListRedirect');

Route::get('/advice/deleteapply/{id}','AdviceController@deleteApply');