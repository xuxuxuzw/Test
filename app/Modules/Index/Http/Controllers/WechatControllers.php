<?php

namespace App\Modules\Index\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EasyWeChat\Factory;
use EasyWeChat\Kernel\Messages\Text;

class WechatControllers extends Controllers
{
    //微信验证
    public function index()
    {
        $app = app('wechat.official_account');
        $response = $app->server->serve();
        return $response;
    }

    public function host_url()
    {
        return 'http://test.xuzhaowen.cn/index/index';
    }

    //网页授权获取openid
    public function oauth_callback()
    {
        //获取app实例
        /** @var \EasyWeChat\OfficialAccount\Application $app */
        $app = app('wechat.official_account');
        $oauth = $app->oauth;
        // 获取 OAuth 授权结果用户信息
        $user = $oauth->user();
        session(['openid' => $user->getId(),'nickname'=>$user->getNickname()]);
        header('location:' . $this->host_url());
    }


    //生成预支付订单
    public function create_prepaid($order_no)
    {
        $app = app('wechat.payment');
        $result = $app->order->unify([
            'body' => 'test',        //传你自己平台的订单介绍
            'out_trade_no' => $order_no,    //传你自己平台的订单号
            'total_fee' => 1,
            'spbill_create_ip' => $_SERVER['REMOTE_ADDR'], // 可选，如不传该参数，SDK 将会自动获取相应 IP 地址
            'notify_url' => 'http://****/order/wx_notify', // 支付结果通知网址，如果不设置则会使用配置里的默认地址
            'trade_type' => 'JSAPI',
            'openid' => session('openid'),
        ]);
        if ($result['return_code'] == "SUCCESS") {
            $jssdk = $app->jssdk;
            $config = $jssdk->sdkConfig($result['prepay_id']);
            //这里easywechat官方函数有问题，修改timestamp为timeStamp
            $config['timeStamp'] = $config['timestamp'];
            unset($config['timestamp']);
            return json_encode($config, JSON_UNESCAPED_UNICODE);
        }
    }


    /* 生成签名
     * @return json
     */

    public function getSign($params)
    {
        ksort($params);        //将参数数组按照参数名ASCII码从小到大排序
        foreach ($params as $key => $item) {
            if (!empty($item)) {         //剔除参数值为空的参数
                $newArr[] = $key . '=' . $item;     // 整合新的参数数组
            }
        }
        $stringA = implode("&", $newArr);         //使用 & 符号连接参数
        $stringSignTemp = $stringA . "&key=" . "*******************";        //一定要修改成自己的key，要不然会报sign签名错误
        // key是在商户平台API安全里自己设置的
        $stringSignTemp = MD5($stringSignTemp);       //将字符串进行MD5加密
        $sign = strtoupper($stringSignTemp);      //将所有字符转换为大写
        return $sign;
    }

    /* 数组转xml
     * @return json
     */

    public function ToXml($data = array())
    {
        if (!is_array($data) || count($data) <= 0) {
            return '数组异常';
        }

        $xml = "<xml>";
        foreach ($data as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else {
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
            }
        }
        $xml .= "</xml>";
        return $xml;
    }

    /* xml转数组
     * @return json
     */

    public function FromXml($xml)
    {
        if (!$xml) {
            echo "xml数据异常！";
        }
        //将XML转为array
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $data;
    }

    /* 随机字符串
     * @return json
     */

    public function rand_code()
    {
        $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'; //62个字符
        $str = str_shuffle($str);
        $str = substr($str, 0, 32);
        return $str;
    }


}
