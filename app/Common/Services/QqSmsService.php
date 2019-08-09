<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/5/4
 * Time: 20:55
 */
namespace App\Common\Services;

use Qcloud\Sms\SmsSingleSender;
class QqSmsService
{
    protected $smsServer;
    protected $sms;
    protected $templateId;

    //在这里传入内部模版ID,和params参数，和发送者数组
    public function __construct(){
        $this->sms = config('qcloudsms');
        $this->smsServer = new SmsSingleSender($this->sms['app_id'],$this->sms['app_key']);
        $this->templateId = '76085';
    }

    public function sendMsg($phone,$code)
    {
        $result = $this->smsServer->sendWithParam(
            '86',
            $phone,
            $this->templateId,
            [$code,30],
            $this->sms['smsSign']
        );
        return json_decode($result, true);
    }
}