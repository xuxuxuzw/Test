<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>登录</title>
        <link rel="stylesheet" href="{{asset('/home/css/common.css')}}">
        <link rel="stylesheet" href="{{asset('/home/css/login.css')}}">
        <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    </head>
    <body>
        <!-- 头部 -->
        <div class="top">
            <a href="javascript:history.go(-1)"><img src="{{asset('/home/img/back.png')}}" alt=""></a>
            <span>登录</span>
        </div>
        <!-- 内容 -->
        <div class="content">
            <ul>
                <li><img src="{{asset('/home/img/phone.png')}}" alt=""><input type="text" class="uPhone" placeholder="请输入手机号" id="phone"></li>
                <li><img src="{{asset('/home/img/code.png')}}" alt=""><input type="text" class="uCode" placeholder="请输入验证码"><span id="mse">发送验证码</span></li>
            </ul>
            <p class="alerts"></p>
            <button class="btns">登录</button>
        </div>
        <script>
            $('body').css('height', $(window).height())
            $('button').click(function () {
                var phone = $('#phone').val();
                var code = $('.uCode').val();
                var rPhone = /^(13[0-9]|15[012356789]|17[035678]|18[0-9]|14[57])[0-9]{8}$/;
                if (!phone||!code) {
                    $('.alerts').show();
                    $(".alerts").html("请将信息填写完整");
                    setTimeout(function () {
                        $('.alerts').hide();
                    }, 2000);
                    return false;
                }
                if (!rPhone.test(phone)) {
                    $('.alerts').show();
                    $(".alerts").html("手机号格式不对");
                    setTimeout(function () {
                        $('.alerts').hide();
                    }, 2000);
                    return false;
                }
                $.ajax({
                    type:'get',
                    url:'/user/login?index.php&mobile='+phone+'&sms_code='+code,
                    dataType:'json',
                    success:function(data){
                        console.log(data.msg)
                        if(data.code==1){
                            window.location='/';
                        }else{
                            $('.alerts').show();
                            $(".alerts").html(data.msg);
                            setTimeout(function () {
                                $('.alerts').hide();
                            }, 2000);
                        }
                    }
                })
            })
            //这里是60秒倒计时逻辑
            var mse = document.getElementById('mse');
            var i = 60;
            var indt;
            $('#mse').click(function () {
                var phone = $('.uPhone').val();
                var regex = /^(13[0-9]|15[012356789]|17[035678]|18[0-9]|14[57])[0-9]{8}$/;
                if (!phone) {
                    $('.alerts').show();
                    $(".alerts").html("请输入手机号");
                    setTimeout(function () {
                        $('.alerts').hide();
                    }, 2000);
                    return false;
                }
                if (!regex.test(phone)) {
                    $('.alerts').show();
                    $(".alerts").html("手机号格式不对");
                    setTimeout(function () {
                        $('.alerts').hide();
                    }, 2000);
                    return false;

                }
                indt = setInterval("fun()", 1000);
                $('.alerts').hide();
                $.ajax({
                     url:'/api/sms/send_verify_code',
                    type: 'post',
                    data: {"mobile": phone},
                    dataType: 'json',
                    success: function (data) {
                        // console.log(data)
                        $('.alerts').show();
                        $(".alerts").html(data.msg);
                        setTimeout(function () {
                            $('.alerts').hide();
                        }, 2000);

                    }
                })
            });
            function fun() {
                if (i == 0) {
                    i = 60;
                    document.getElementById("mse").innerHTML = "获取验证码";
                    document.getElementById("mse").removeAttribute("disabled");
                    document.getElementById("mse").style.fontSize = "0.9rem";
                    clearInterval(indt);
                } else {
                    document.getElementById("mse").innerHTML = i + "秒后重新发送";
                    document.getElementById("mse").setAttribute("disabled", true);
                    document.getElementById("mse").style.fontSize = "0.9rem";
                    i--;
                }
            }
        </script>
    </body>
</html>