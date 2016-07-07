<!DOCTYPE html>
<html lang="zh-CN" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="Ease Project">
    <meta name="author" content="cristph">
    <link rel="icon" href="../../favicon.ico">

    <title>Ease | 账户设置</title>

    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/reset.css" rel="stylesheet">
    <link href="/css/common.css" rel="stylesheet">
    <link href="/css/usersetting.css" rel="stylesheet">
    <link href="/css/buttons.css" rel="stylesheet">
    <link href="/css/footer.css" rel="stylesheet">
</head>

<body>

<nav class="navbar navbar-fixed-top navbar-custom">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Ease</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/health">健康管理</a></li>
                <li><a href="/bbs">朋友圈</a></li>
                <li><a href="/activity">活动</a></li>
                <li><a href="/advice">建议</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="/user/setting">设置</a></li>
                <li><a href="/logout">登出</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="outer-frame">
    <div class="container inner-frame">
        <div class="row main-frame">
            <div class="col-sm-2 frame-left">
                <a href="/user/settingredirect"><div class="setting-left">我的信息</div></a>
                <a href="/user/setavatarredirect"><div class="setting-left">头像设置</div></a>
                <a href="/user/resetpswdredirect"><div class="setting-left">重置密码</div></a>
                <a href="/user/authdredirect"><div class="setting-left">权限管理</div></a>
            </div>

            <div class="col-sm-9 frame-middle">

                <div class="title-box">账户设置</div>

                <div class="white-box">

                    <form class="form-horizontal form-wrapper" method="post" action="/user/savesetting" accept-charset="utf-8">

                        <div class="form-group form-line">
                            <label for="inputEmail3" class="col-sm-2 control-label">昵称：</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control from-input" name="nickname" id="inputEmail3" value={{$user->nickname}}>
                            </div>
                        </div>

                        <div class="form-group form-line">
                            <label for="inputEmail3" class="col-sm-2 control-label">性别：</label>
                            <div class="col-sm-10">
                                @if($user->sex==1)
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" id="inlineRadio1" value="1" checked="checked"> 男
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" id="inlineRadio2" value="2"> 女
                                    </label>
                                @else
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" id="inlineRadio1" value="1"> 男
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="sex" id="inlineRadio2" value="2" checked="checked"> 女
                                    </label>
                                @endif
                            </div>
                        </div>

                        <div class="form-group form-line">
                            <label for="inputEmail3" class="col-sm-2 control-label">所在地：</label>
                            <div class="col-sm-10">
                                <select class="form-control from-input" name="area">
                                    <option>江苏</option>
                                    <option>浙江</option>
                                    <option>上海</option>
                                    <option>湖南</option>
                                    <option>湖北</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group form-line">
                            <label for="inputEmail3" class="col-sm-2 control-label">生日：</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control from-input" name="birthday" value={{$user->birthday}}>
                            </div>
                        </div>

                        <div class="form-group form-line">
                            <label for="inputPassword3" class="col-sm-2 control-label">个人简介：</label>
                            <div class="col-sm-10">
                                <textarea class="form-control from-input" name="selfintro" rows="3">{{$user->selfintro}}</textarea>
                            </div>
                        </div>

                        <div class="form-group form-line">
                            <label for="inputPassword3" class="col-sm-2 control-label">联系方式：</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control from-input" name="contact" value={{$user->contact}}>
                            </div>
                        </div>

                        <div class="form-group form-line">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-default">保存</button>
                            </div>
                        </div>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 text-center">
                <a href="/">Home</a>
                <a href="/terms" target="_blank">Terms</a>
                <a href="/privacy" target="_blank">Privacy</a>
                <a href="https://twitter.com/wiplohq" target="_blank" rel="nofollow">Twitter</a>
                <a href="mailto:team@wiplo.com?subject=Hi Wiplo Team!" rel="nofollow">Contact</a>
                <small>Architect @ Cristph</small>
            </div>
        </div>
    </div>
</footer>


<script src="//cdn.bootcss.com/jquery/1.11.3/jquery.min.js"></script>
<script src="//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="/js/common.js"></script>
</body>
</html>