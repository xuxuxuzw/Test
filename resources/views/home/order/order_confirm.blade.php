<!DOCTYPE html>
<html lang="zh">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>支付详情</title>
    </head>
    <body>
        <div class="top">
            <span>支付详情</span>
        </div>
        <!--你自己的支付确认页面-->
        <button id="btn-do-it" class="buybtn" onclick="callpay()">确认支付</button>
    </body>
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    
    <script>
        
        //调用微信JS api 支付
        function jsApiCall()
        {
            WeixinJSBridge.invoke(
                'getBrandWCPayRequest',<?php echo htmlspecialchars_decode($config);?>,
                function(res){
                    if (res.err_msg == "get_brand_wcpay_request:ok") { // 支付成功
                        alert('支付成功');
                        window.location.href="***";  //你想跳转的页面
                    }
                    if(res.err_msg == "get_brand_wcpay_request:fail") { // 支付失败
                        alert('支付失败');
                    }
                    if (res.err_msg == "get_brand_wcpay_request:cancel") { // 取消支付
                        alert('取消支付');
                    }
                }
            );
        }

        function callpay()
        {
            if (typeof WeixinJSBridge == "undefined"){
                if( document.addEventListener ){
                    document.addEventListener('WeixinJSBridgeReady', jsApiCall, false);
                }else if (document.attachEvent){
                    document.attachEvent('WeixinJSBridgeReady', jsApiCall);
                    document.attachEvent('onWeixinJSBridgeReady', jsApiCall);
                }
            }else{
                jsApiCall();
            }
        }
    </script>
</html