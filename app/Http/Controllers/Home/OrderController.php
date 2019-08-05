<?php
namespace App\Http\Controllers\Home;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redis as Redis;
class OrderController extends Controller
{
    
	/* 支付订单
     * @return view
     */
    public function pay_order(Request $request){
        $order_no			= 123457890;//填写自己站内的订单编号
		$wechat             = new WechatController();
		$config             = $wechat->create_prepaid($order_no);
        return view('home.order.order_confirm',['config'=>$config]);
            
    }
    
	
    
    /* 微信支付回调
     * @return json
     */
    public function wx_notify() {
        //接收微信返回的数据数据,返回的xml格式
        $wxpay                      = new WechatController();
        $xmlData                    = file_get_contents('php://input');
        //将xml格式转换为数组
        $data                       = $wxpay->FromXml($xmlData);
        //记录支付结果logs/wxpay/wxpay.log是你自己定义日志的路径，根据自己项目设置
        $log                        = new \Monolog\Logger('wxpay');
        $log->pushHandler(new \Monolog\Handler\StreamHandler(storage_path('logs/wxpay/wxpay.log'),\Monolog\Logger::INFO) );
        $log->addInfo('支付返回:'. $xmlData);
        //为了防止假数据，验证签名是否和返回的一样。
        //记录一下，返回回来的签名，生成签名的时候，必须剔除sign字段。
        $sign                       = $data['sign'];
        unset($data['sign']);
        if ($sign == $wxpay->getSign($data)) {
            //签名验证成功后，判断返回微信返回的
            if ($data['result_code']== 'SUCCESS') {
                //支付成功返回业务处理
                //处理自己站的业务信息
				
                //处理完成之后，告诉微信成功结果！
				echo '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
                exit();
                
            }
            
        } else {
            $log                    = new \Monolog\Logger('wxpaysign');
            $log->pushHandler(new \Monolog\Handler\StreamHandler(storage_path('logs/wxpay/wxpaysign.log'),\Monolog\Logger::INFO) );
            $log->addInfo("错误信息:签名验证失败" . date("Y-m-d H:i:s"), time() . "\r\n");
        }
    }
    
    
    
   
}
