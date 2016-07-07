<!DOCTYPE html>
<html lang="zh-CN" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="Ease Project">
    <meta name="author" content="cristph">
    <link rel="icon" href="../../favicon.ico">

    <title>Ease | 收到的求助</title>

    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/reset.css" rel="stylesheet">
    <link href="/css/common.css" rel="stylesheet">
    <link href="/css/postActivity.css" rel="stylesheet">
    <link href="/css/buttons.css" rel="stylesheet">
    <link href="/css/footer.css" rel="stylesheet">
    <link href="/css/adviser.css" rel="stylesheet">
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
                <a href="/advice/adviserredirect"><div class="setting-left">求助列表</div></a>
                <a href="/advice/postAdviceredirect"><div class="setting-left">给出的建议</div></a>
            </div>

            <div class="col-sm-7 frame-middle">
                <div class="title-box">求助列表</div>
                <div class="chart-box">

                    @foreach($applies as $apply)
                        <div class="well">
                            <form novalidate="novalidate" method="post" action="/advice/post">
                                <div class="bbs-input-title">{{$apply->userName}} 向您请求建议：</div>
                                <textarea class="form-control bbs-input" rows="3" name="content"></textarea>
                                <input type="submit" value="提交建议" class="button button-primary button-rounded button-small bbs-post-btn">
                                <input type="hidden" name="id" value={{$apply->id}}>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                            </form>
                        </div>
                    @endforeach

                        @if(count($applies)==0)
                            <div class="white-box">
                                <div class="well well-cus">
                                    <label>
                                        您暂时没有收到任何建议请求……
                                    </label>
                                </div>
                            </div>
                        @endif
                </div>

            </div>

            <div class="col-sm-3 frame-right">
                <div class="user-info">
                    <div class="user-bg"></div>
                    <div class="img-div"><img  alt="user img" class="user-img" src={{Session::get('avatar')}}></div>
                    <div class="user-name">{{Session::get('userName')}}</div>
                    <div class="basic-info">
                        <label>
                            @if(Session::get('userAuth')==1)
                                普通用户
                            @elseif(Session::get('userAuth')==2)
                                认证医生
                            @elseif(Session::get('userAuth')==3)
                                认证教练
                            @else
                                系统管理员
                            @endif
                        </label>
                        <label>|</label>
                        <label>
                            @if(is_null(Session::get('sex')))
                                性别保密
                            @else
                                @if(Session::get('sex')==1)
                                    男
                                @else
                                    女
                                @endif
                            @endif
                        </label>
                    </div>
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