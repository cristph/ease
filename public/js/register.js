/**
 * Created by cristph on 2015/12/1.
 */

//function checkValidation(){
//
//}
//
//$('#submitForm').click(
//    function(){
//        //其次验证剩余输入合法性
//        var email=document.getElementById('email').value;
//        var nickname=document.getElementById('nickname').value;
//        var password=document.getElementById('post-password').value;
//
//        alert(email+"  "+nickname+" "+password);

//        $.post(
//            "{{ action('UserController@register') }}",
//            {
//                'email':email,
//                'nickname':nickname,
//                'password':password
//            },function(data){
//                alert("hehe");
//            }
//        );
//
//        alert("haha");
//    }
//);


$('#email').blur(function(){

    $.ajax({
        type: 'POST',
        url: '/register/validate',
        data: {
            "email":document.getElementById('email').value
        },
        dataType: 'json',
        success: function(data){
            var result=data['result'];
            if(result=='fail'){
                alert('该邮箱已被注册');
            }
        },
        error: function(XMLHttpRequest, textStatus, errorThrown) {
            alert(XMLHttpRequest.status);
            alert(XMLHttpRequest.readyState);
            alert(textStatus);
            alert(errorThrown);
        },
    });

});
