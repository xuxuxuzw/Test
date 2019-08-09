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

    //在这里传入内部模版ID,和params参数，和发送者数组
    public function __construct($templateId = 'tqHm6cg4QkrAsbwCF3eT7CeaUlxQlJkRZyJ5uVfCpPE')
    {
        $this->templateId = $templateId;
    }

    public function sendMsg($ToOpenid = ['oEOT9wAU6gHTzIb89ENn_CtytJ08'])
    {
        /** @var \EasyWeChat\OfficialAccount\Application $app */
        $app = app('wechat.official_account');
        $result = [];
        foreach ($ToOpenid as $openid) {
            $result[$openid] = $app->template_message->send([
                'touser' => $openid,
                'template_id' => $this->templateId,
                'url' => 'http://test.xuzhaowen.cn/',
                'scene' => 1000,
                'data' => [
                    'nickname' => 'xzw',
                    'openid' => $openid,
                    'web' => '管理系统',
                    'www' => 'test.xuzhaowen.cn',
                    'time' => date('Y年m月d日h:i')
                ],
            ]);
        }
        return $result;
    }
}