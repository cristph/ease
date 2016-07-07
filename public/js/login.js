/**
 * Created by cristph on 2015/12/2.
 */

//function checkInput(){
//    var email=document.getElementById('email').value;
//    var password=document.getElementById('password').value;
//}
//
//$('#submitLogin').click(
//   function(){
//       var email=document.getElementById('email').value;
//       var password=document.getElementById('password').value;
//
//       //alert(email+" "+password);
//
//       if(email.length==0){
//           alert('邮箱不能为空');
//           return;
//       }
//
//       if(password.length==0){
//           alert('密码不能为空');
//           return;
//       }
//
//       $.ajax({
//           type: 'POST',
//           url: '/login/post',
//           data: {
//               "email":email,
//               "password":password
//           },
//           dataType: 'json',
//           success: function(data){
//               $result=data['result'];
//               if($result=='success'){
//                   alert('success');
//                   $.post(
//                       '/login/success',
//                       { "email":email}
//                   );
//               }else{
//                   alert($result);
//               }
//           },
//           error: function(xhr, type){
//               alert('Ajax error!');
//           }
//       });
//   }
//);
