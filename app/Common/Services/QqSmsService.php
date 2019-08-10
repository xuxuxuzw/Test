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
    public function __construct()
    {
        $this->sms = config('qcloudsms');
        $this->smsServer = new SmsSingleSender($this->sms['app_id'], $this->sms['app_key']);
        $this->templateId = '76085';
    }

    public function sendMsg($message)
    {
        $message['params'] = is_array($message['params']) ? $message['params'] : json_decode($message['params'], true);
        ksort($message['params']);
        $message['params'] = array_values($message['params']);
        $result = $this->smsServer->sendWithParam(
            '86',
            !empty($message['receiver_source_id']) ? $message['receiver_source_id'] : '18320029829',
            $message['cp_out_template_no'] ? $message['cp_out_template_no'] : $this->templateId,
            $message['params'],
            $this->sms['smsSign']
        );
        return is_array($result) ? $result : json_decode($result, true);
    }
}