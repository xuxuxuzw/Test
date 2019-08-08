<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/5/4
 * Time: 20:57
 */
namespace App\Modules\Common\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QqSmsService;
use App\Services\WechatService;
use App\Services\MailService;
use Illuminate\Support\Facades\Mail;

class MsgContentControllers extends Controllers
{
    public function sendQqSms(QqSmsService $QqSmservice,Request $request)
    {
        $code = mt_rand(0,9999);
        $code = str_pad($code,4,0,STR_PAD_RIGHT);
        $phone = $request->get('phone');
        $result = $QqSmservice->sendMsg($phone,$code);
        if (isset($result['result']) && $result['result'] == 0){
            return $result;
        }else{
            return $result;
        }
    }
    public function sendWxMsg(WechatService $Wechatervice,Request $request)
    {
        $code = mt_rand(0,9999);
        $code = str_pad($code,4,0,STR_PAD_RIGHT);

        $result = $Wechatervice->sendMsg(['oEOT9wAU6gHTzIb89ENn_CtytJ08']);
        if (isset($result['result']) && $result['result'] == 0){
            return $result;
        }else{
            return $result;
        }
    }
    public function sendMail(MailService $MailService,Request $request)
    {
        $code = mt_rand(0,9999);
        $code = str_pad($code,4,0,STR_PAD_RIGHT);
        $phone = $request->get('phone');
        $result = $MailService->sendMsg($phone,$code);
        if (isset($result['result']) && $result['result'] == 0){
            return $result;
        }else{
            return $result;
        }
    }

    public function send() {
        $name = '我发的邮件 '.date('Y-m-d H:i:s');
        // Mail::send()的返回值为空，所以可以其他方法进行判断
        Mail::send('common::emails.test',['name'=>$name],function($message){
            $to = '1315915745@qq.com'; $message ->to($to)->subject('邮件测试');
        });
        // 返回的一个错误数组，利用此可以判断是否发送成功
        dd(Mail::failures());
    }


}