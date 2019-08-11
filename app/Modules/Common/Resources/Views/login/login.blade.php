<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel</title>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="content">
        <div style="text-align: center">
            <img src="/images/c43e884352f59a4d23574aebaeb97f3.png" alt=""><br>
            <a href="{{route('wechat.web.login')}}" style="font-size: 30px"> 测试微信扫码登录</a>
        </div>
    </div>
    @include('wechat_web_login')
</div>
</body>
</html>
