<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/5/4
 * Time: 20:55
 */

namespace App\Common\Services;

class WechatService
{
    protected $templateId;
    protected $app;

    //在这里传入内部模版ID,和params参数，和发送者数组
    public function __construct($templateId = 'tqHm6cg4QkrAsbwCF3eT7CeaUlxQlJkRZyJ5uVfCpPE')
    {
        /** @var \EasyWeChat\OfficialAccount\Application $app */
        $this->app = app('wechat.official_account');

        $this->templateId = $templateId;
    }

    public function sendMsg($message)
    {
        $message['params'] = is_array($message['params']) ? $message['params'] : json_decode($message['params'], true);
        $data = [];
        foreach ($message['params'] as $key => $value) {
            if ($key == 'redirect_url') continue; // redirect_url 是跳转链接，特殊参数
            if (in_array($key, ['miniprogram_appid', 'miniprogram_pagepath'])) continue; // 调整小程序所需数据，特殊参数
            $data[$key] = ['value' => $value, 'color' => '#000000'];
        }

        $message_data = [
            'touser' => !empty($message['receiver_source_id']) ? $message['receiver_source_id'] : 'oEOT9wAU6gHTzIb89ENn_CtytJ08',
            'template_id' => $message['cp_out_template_no'] ? $message['cp_out_template_no'] : $this->templateId,
            'url' => !empty($message['params']['redirect_url']) ? $message['params']['redirect_url'] : '',
            'topcolor' => '#f7f7f7',
            'scene' => 1000,
            'data' => $data,
        ];

        $result = $this->app->template_message->send($message_data);

        return $result;
    }
}