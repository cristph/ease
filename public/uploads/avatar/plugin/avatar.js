var cutPhotoJs = function() {
    return {
        initSystems : function() {
    		var soCut = new SWFObject("uploads/avatar/plugin/avatar.swf", "qqminiblog", "100%", "100%", "9.0.28", "#FFFFFF");
    			soCut.addParam("allowNetworking", "all");
    			soCut.addParam("allowScriptAccess", "sameDomain");
    			soCut.addParam("allowFullScreen", "true");
    			soCut.addParam("scale", "noscale");
    			soCut.addParam("wmode", "transparent");
    			soCut.addVariable("wbVipWhite", "true");
    			soCut.addVariable("uidurl", _uidurl+"?cache="+Math.random());
    			soCut.addVariable("tmpurl", _tmpurl);
    			soCut.addVariable("tmpimgurl", "noavatar_big.gif");
    			soCut.addVariable("imgurl", _imgurl);
    			soCut.addVariable("langver", "zh_CN");
                soCut.addVariable("token", _token);
                soCut.addVariable("_ps1", "gettmp");
                soCut.addVariable("_ps2", "null");
                soCut.addVariable("xmlurl", "uploads/avatar/plugin/picdata.xml");
                soCut.addVariable("headpretty", "true");
    			soCut.write("cutphoto");
    	},
        uploadFileError : function(type, code) {
    		if ( type == 'filesize')
    		{
    			alert('文件大小不超过2M');
    		}
    		else if ( type == 'filename')
    		{
    			alert('请选择jpg、jpeg、gif、png格式的图片');
    		}
    	},
    	uploadingError : function(ecode) {
    		alert('似乎发生了一点点意外。请稍后重试');
    	},
    	uploadingSucess : function(scode) {
    	},
    	uploadedError : function(ecode) {
    	    if (ecode == '-1')
    		{
    			alert('请选择jpg、jpeg、gif、png格式的图片');
    		}
    		else if (ecode == '-2')
    		{
    			alert('文件大小不超过2M');
    		}
    		else if (ecode == '-3')
    		{
    			alert('您的登录状态消失，请重新登录');
    			window.location.href="{{ url('/auth/login') }}";
    		}
    		else
    		{
    			alert('似乎发生了一点点意外，请稍后重试');
    		}
    	},
    	uploadedSucess : function(scode,type) {
    	    alert("您的头像已修改成功！");
    		window.location.reload();
    	},
    	cancelProgramm: function() {
    		window.location.reload();
    	}
    }
}();

function isCanUseCustomHead(){
    if(_gid == 1){
        return 1;
    }else{
        return 0;
    }
}
function adjustFlashHeigh(v){
	$('cutphoto').style.height = v + 'px';
    if($("qqminiblog"))
    {
        $('qqminiblog').style.height = v + 'px';
    }
}
function dispatchAS3Method(v,param){
	if (v == 'error_use_custom_head'){
        var WBvipWhite = 1;
        if(WBvipWhite == 1){
        	alert('您当前的用户组无法保存相框效果（'+param+'） ');
        }else{
        	alert('您当前的用户组无法保存相框效果（'+param+'） ');
        }
	}
}