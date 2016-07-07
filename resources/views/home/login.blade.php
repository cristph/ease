<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Ease Project">
    <meta name="author" content="cristph">
    <link rel="icon" href="../../favicon.ico">

    <title>Ease Login</title>

    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/reset.css" rel="stylesheet">
    <link href="/css/login.css" rel="stylesheet">
    <link href="/css/footer.css" rel="stylesheet">
</head>

<body>
<div class="outer-wrapper">
    <div class="container inner-wrapper">
        <div class="row">

            <div class="col-md-8 login-left"></div>
            <div class="col-md-4 login-right">
                <form id="login" novalidate="novalidate" method="post" action="/login/post">
                    <div class="form-group id-group">
                        <label for="email">邮箱</label>
                        <input type="text" class="form-control" name="email" id="email">
                        @if(isset($email_msg))
                            <label style="color: white">{{$email_msg}}</label>
                        @endif
                    </div>
                    <div class="form-group pswd-group">
                        <label for="password">密码</label>
                        <input type="password" class="form-control" name="password" id="password">
                        @if(isset($pswd_msg))
                            <label style="color: white">{{$pswd_msg}}</label>
                        @endif
                    </div>
                    <input type="submit" value="登陆" class="btn btn-block login-btn" id="submitLogin">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                </form>

                <div class="form-footer">
                    加入我们？<br>
                    <a href="/register">->注册账号</a>
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
<script src="/js/login.js"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });
</script>
</body>
</html>