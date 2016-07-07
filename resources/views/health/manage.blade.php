<!DOCTYPE html>
<html lang="zh-CN" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <meta name="description" content="Ease Project">
    <meta name="author" content="cristph">
    <link rel="icon" href="../../favicon.ico">

    <title>Ease</title>

    <link href="//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/reset.css" rel="stylesheet">
    <link href="/css/common.css" rel="stylesheet">
    <link href="/css/health.css" rel="stylesheet">
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
                <a href="/health"><div class="setting-left">健康管理</div></a>
                <a href="/health/loadData"><div class="setting-left">上传数据</div></a>
            </div>

            <div class="col-sm-10 frame-middle">
                <div class="white-box" style="padding: 20px">
                    <div id="main" style="height:400px;"></div>
                </div>
            </div>

            <div id="email" hidden>{{Session::get('userEmail')}}</div>
            <label id="str" hidden></label>

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
<script src="js/echarts-all.js"></script>
<script>
    $.ajaxSetup({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
    });

    var myChart;

    var option;

    $(function(){
        var email=document.getElementById('email').innerHTML;
        var res=[];
        $.ajax({
            type: 'POST',
            url: '/health/getdata',
            data: {
                "email":email
            },
            dataType: 'json',
            success: function(data){
                var temp=data;
                for(var i=0;i<temp.length;i++){
                    var date=temp[i]['date'];
                    var rate=temp[i]['rate'];

                    var datestr=date.split('-');
                    var d=new Date(datestr[0],parseInt(datestr[1])-1,datestr[2]);
                    var r=parseInt(rate);
                    res.push([d,r]);
                }

                document.getElementById('str').innerHTML=str;

                myChart = echarts.init(document.getElementById('main'));
                option = {
                    title : {
                        text : '心率-日期坐标折线图',
                    },
                    tooltip : {
                        trigger: 'item',
                        formatter : function (params) {
                            var date = new Date(params.value[0]);
                            data = date.getFullYear() + '-'
                                    + (date.getMonth() + 1) + '-'
                                    + date.getDate() ;
                            return data+" "+params.value[1];
                        }
                    },
                    toolbox: {
                        show : true,
                        feature : {
                            mark : {show: true},
                            dataView : {show: true, readOnly: false},
                            restore : {show: true},
                            saveAsImage : {show: true}
                        }
                    },
                    dataZoom: {
                        show: true,
                        start : 70
                    },
                    legend : {
                        data : ['series1']
                    },
                    grid: {
                        y2: 80
                    },
                    xAxis : [
                        {
                            type : 'time',
                            splitNumber:10
                        }
                    ],
                    yAxis : [
                        {
                            type : 'value'
                        }
                    ],
                    series : [
                        {
                            name: 'series1',
                            type: 'line',
                            showAllSymbol: true,
                            symbolSize: function (value){
                                return  0.5;
                            },
                            data: (function () {
                                return res;
                            })()
                        }
                    ]
                };
                myChart.setOption(option);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert(XMLHttpRequest.status);
                alert(XMLHttpRequest.readyState);
                alert(textStatus);
                alert(errorThrown);
            },
        });
    });



</script>
</body>
</html>