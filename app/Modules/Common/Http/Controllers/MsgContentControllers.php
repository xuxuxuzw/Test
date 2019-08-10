<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/5/4
 * Time: 20:57
 */

namespace App\Modules\Common\Http\Controllers;

use App\Common\Models\MsgContent;
use App\Common\Repositories\MsgChannelRepositories;
use App\Common\Repositories\MsgContentRepositories;
use App\Common\Repositories\MsgTemplateRepositories;
use App\Common\Services\MsgService;
use Illuminate\Http\Request;
use App\Common\Services\QqSmsService;
use App\Common\Services\WechatService;
use App\Common\Services\MailService;
use Illuminate\Support\Facades\Mail;

class MsgContentControllers extends Controllers
{

    protected $msg_channel_repositories;
    protected $msg_template_repositories;
    protected $msg_content_repositories;

    public function __construct()
    {
        $this->msg_channel_repositories = new MsgChannelRepositories();//消息通道

        $this->msg_template_repositories = new MsgTemplateRepositories();//消息模板

        $this->msg_content_repositories = new MsgContentRepositories();//消息内容
    }

    public function test()
    {
        return (new MsgService())->handle();
    }

    public function testAddQqSms()
    {
        //echo "<pre>";
//        $result = $this->msg_channel_repositories->getMsgChannel(2);
//        var_dump($result);
        //$msg_template = $this->msg_template_repositories->getMsgTemplate(2);
//        var_dump($msg_template);
//exit;
        //$result = $this->msg_content_repositories->getMsgContent(1);

        $code = mt_rand(0, 9999);
        $code = str_pad($code, 4, 0, STR_PAD_RIGHT);

        $receiver_source_ids = ['receiver_source_ids' => ['18320029829']];
        $template_params = [
            'value1' => date('m',time()),
            'value2' => date('d',time()),
            'value3' => date('H',time()),
            'value4' => date('i',time()),
            'value5' => '广州天河',
        ];
        return (new MsgService())->push(3, $receiver_source_ids, $template_params);
    }

    public function testAddMsgWechat()
    {
        //echo "<pre>";
//        $result = $this->msg_channel_repositories->getMsgChannel(2);
//        var_dump($result);
        //$msg_template = $this->msg_template_repositories->getMsgTemplate(2);
//        var_dump($msg_template);
//exit;
        //$result = $this->msg_content_repositories->getMsgContent(1);
        $receiver_source_ids = ['receiver_source_ids' => ['oEOT9wAU6gHTzIb89ENn_CtytJ08', 'oEOT9wAQIoLqGzPd-agIVZ9OG-DA']];
        $template_params = [
            'code' => 'http://test.xuzhaowen.cn/index/index',
            'nickname' => 'xzw',
            'openid' => 'oEOT9wAU6gHTzIb89ENn_CtytJ08',
            'web' => '管理系统',
            'www' => 'test.xuzhaowen.cn',
            'time' => date('Y年m月d日h:i')
        ];
        return (new MsgService())->push(2, $receiver_source_ids, $template_params);
    }

    public function sendQqSms(QqSmsService $QqSmservice, Request $request)
    {
        $code = mt_rand(0, 9999);
        $code = str_pad($code, 4, 0, STR_PAD_RIGHT);
        $phone = $request->get('phone');
        $result = $QqSmservice->sendMsg($phone, $code);
        if (isset($result['result']) && $result['result'] == 0) {
            return $result;
        } else {
            return $result;
        }
    }

    public function sendWxMsg(WechatService $Wechatervice, Request $request)
    {
        $code = mt_rand(0, 9999);
        $code = str_pad($code, 4, 0, STR_PAD_RIGHT);

        $result = $Wechatervice->sendMsg(['oEOT9wAU6gHTzIb89ENn_CtytJ08']);
        if (isset($result['result']) && $result['result'] == 0) {
            return $result;
        } else {
            return $result;
        }
    }

    public function sendMail(MailService $MailService, Request $request)
    {
        $code = mt_rand(0, 9999);
        $code = str_pad($code, 4, 0, STR_PAD_RIGHT);
        $phone = $request->get('phone');
        $result = $MailService->sendMsg($phone, $code);
        if (isset($result['result']) && $result['result'] == 0) {
            return $result;
        } else {
            return $result;
        }
    }

    public function send()
    {
        $name = '我发的邮件 ' . date('Y-m-d H:i:s');
        // Mail::send()的返回值为空，所以可以其他方法进行判断
        Mail::send('common::emails.test', ['name' => $name], function ($message) {
            $to = '1315915745@qq.com';
            $message->to($to)->subject('邮件测试');
        });
        // 返回的一个错误数组，利用此可以判断是否发送成功
        dd(Mail::failures());
    }


}