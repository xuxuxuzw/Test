<!DOCTYPE html>
<html lang="zh-cn">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>MIA</title>
        <link rel="stylesheet" href="{{asset('/home/css/common.css')}}">
        <script src="https://apps.bdimg.com/libs/jquery/2.1.4/jquery.min.js"></script>
    </head>
    <body>
        <!-- 头部 -->
        <div class="top">
            <span>首页</span>
        </div>
        <!-- 内容 -->
        <div class="content" style="margin-top: 20%">
            <a href="/order/buy_ticket">购票</a><a href="/order/order_list">
        {{$nickname}} -个人中心- {{$openid}}</a>
        </div>
        
    </body>
</html>