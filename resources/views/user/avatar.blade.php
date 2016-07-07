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

    <title>Ease | 头像设置</title>

    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/reset.css" rel="stylesheet">
    <link href="/css/common.css" rel="stylesheet">
    <link href="/css/usersetting.css" rel="stylesheet">
    <link href="/css/buttons.css" rel="stylesheet">
    <link href="/css/footer.css" rel="stylesheet">
    <link href="/css/avatar.css" rel="stylesheet">
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

                <div class="title-box">头像设置</div>

                <div class="white-box" style="padding-top: 0!important;">
                    <div class="well">
                        <header class="profile-header">

                            <label>头像预览</label>
                            <img id="user-avatar" class="user-avatar" src={{Session::get('avatar')}}>
                            <label id="upload-avatar"></label>
                            <div id="validation-errors"></div>

                            <div class="avatar-upload" id="avatar-upload">
                                {!! Form::open( [ 'url' => ['/user/avatar'], 'method' => 'POST', 'id' => 'upload', 'files' => true ] ) !!}
                                <a href="#" class="btn button-change-profile-picture">
                                    <label for="upload-profile-picture">

                                        <input name="image" id="image" type="file" class="form-control manual-file-chooser js-manual-file-chooser js-avatar-field">
                                    </label>
                                </a>
                                {!! Form::close() !!}


                                <div class="span5">
                                    <div id="output" style="display:none"></div>
                                </div>

                            </div>

                            <span id="filename"></span>
                        </header>
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
<script src="/js/jquery.form.js"></script>

<script>
    $(document).ready(function() {
        var options = {
            beforeSubmit:  showRequest,
            success:       showResponse,
            dataType: 'json'
        };
        $('#image').on('change', function(){
            $('#upload-avatar').html('正在上传...');
            $('#upload').ajaxForm(options).submit();
        });
    });
    function showRequest() {
        $("#validation-errors").hide().empty();
        $("#output").css('display','none');
        return true;
    }

    function showResponse(response)  {
        if(response.success == false)
        {
            var responseErrors = response.errors;
            $.each(responseErrors, function(index, value)
            {
                if (value.length != 0)
                {
                    $("#validation-errors").append('<div class="alert alert-error"><strong>'+ value +'</strong><div>');
                }
            });
            $("#validation-errors").show();
        } else {
            $('#upload-avatar').html('上传成功');
            $('#user-avatar').attr('src',response.avatar);
        }w
    }

</script>
</body>
</html>