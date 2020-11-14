<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:57:"D:\shop\public/../application/admin\view\login\login.html";i:1604713977;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="/static/admin/Styles/general.css" rel="stylesheet" type="text/css" />
<link href="/static/admin/Styles/main.css" rel="stylesheet" type="text/css" />
</head>
<body style="background: #278296;color:white">
<form method="post" action=""onsubmit="return validate()">
    <table cellspacing="0" cellpadding="0" style="margin-top:100px" align="center">
        <tr>
            <td>
                <img src="/static/admin/Images/login.png" width="178" height="256" border="0" alt="ECSHOP" />
            </td>
            <td style="padding-left: 50px">
                <table>
                    <tr>
                        <td>管理员姓名：</td>
                        <td>
                            <input type="text" name="username" />
                        </td>
                    </tr>
                    <tr>
                        <td>管理员密码：</td>
                        <td>
                            <input type="password" name="password" />
                        </td>
                    </tr>
                    <tr>
                        <td>验证码：</td>
                        <td>
                            <input type="text" name="captcha" class="capital" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" >
                            <image style="width:100px; height: 50px; margin-left: 30px" src ='<?php echo url('login/captcha'); ?>' id='img'></image>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" align="right">
                            <img src="" />
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="checkbox" value="1" name="remember" id="remember" />
                            <label for="remember">请保存我这次的登录信息。</label>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <input type="button" value="进入管理中心" class="button" />
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
  <input type="hidden" name="act" value="signin" />
</form>
</body>
<script>
    document.getElementById('img').onclick =function (){
        document.getElementById('img').src='<?php echo url('captcha','id='.mt_rand()); ?>';
    }
</script>
<script type="text/javascript" src ="/static/admin/JS/jquery-1.8.3.min.js"></script>
<script>
    $('.button').live('click',function (){
        var remember = $('#remember').prop('checked')?1:0;
        var postdata = {
            username:$('input[name="username"]').val(),
            password:$('input[name="password"]').val(),
            captcha:$('.capital').val(),
            remember: remember

        }

        $.ajax({
            url:'<?php echo url("dologin"); ?>',
            type:'post',
            data:postdata,
            success:function (res){
                if(res.code ==0){
                    alert(res.data);
                }else if(res.code == 1){
                    location.href='<?php echo url("index/index"); ?>';
                }
            }
        })
    })
</script>