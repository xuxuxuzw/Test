<?php
/**
 * Created by PhpStorm.
 * User: echo
 * Date: 2018/11/23
 * Time: 11:26
 */

namespace App\Http\Controllers;

use EasyWeChat\Kernel\Messages\TextCard;
use Illuminate\Http\Request;
use App\Common\Models\User;
use EasyWeChat\Factory;

class CommonWechatController extends BaseWechatController
{
    public function getApp()
    {
        $options = [
            'app_id' => env('WECHAT_OFFICIAL_ACCOUNT_APPID'),
            'secret' => env('WECHAT_OFFICIAL_ACCOUNT_SECRET'),
            'token' => env('WECHAT_OFFICIAL_ACCOUNT_TOKEN'),
            'log' => [
                'level' => env('WECHAT_LOG_LEVEL'),
                'file' => storage_path(env('WECHAT_LOG_FILE')),
            ],
            'oauth' => [
                'scopes' => array_map('trim', explode(',', env('WECHAT_OFFICIAL_ACCOUNT_OAUTH_SCOPES'))),
                'callback' => '/wechat/common/callback',
            ],
        ];
        /** @var \EasyWeChat\OfficialAccount\Application $app */
        $app = Factory::officialAccount($options);
        return $app;
    }

    public function callback(Request $request)
    {
        $app = $this->getApp();
        //$app = app('wechat.official_account');
        $user = $app->oauth->setRequest($request)->user();
        $original = $user->getOriginal();
        $array = array_only($original, array(
            'openid',
        ));

        $openId = $array['openid'];

        $user = User::where('openid', $openId)->first();
        if ($user) {
            \Auth::login($user);
        } else {
            $userNew = User::create($array);
            \Auth::login($userNew);
        }
        return redirect()->intended('/common');
    }

    public function jsConfig()
    {
        $app = $this->getApp();
        //$app = app('wechat.official_account');
        $js = $app->jssdk;
        if (request()->url) {
            $js->setUrl(request()->url);
        }

        $jsConfig = json_decode($js->buildConfig(array('updateAppMessageShareData', 'updateTimelineShareData', 'onMenuShareAppMessage', 'onMenuShareTimeline', 'onMenuShareAppMessage', 'getLocation', 'openLocation'), true));
        return json_encode(['errorCode' => 0, 'errorMsg' => 'ok', 'data' => ['js_config' => $jsConfig]]);
    }

    public function sendWorkWechatMsg()
    {
        // 获取 Messenger 实例
        $app = $this->getWorkApp();
//        $result = $app->user->mobileToUserId('18320029829');
//        dd($result);
//
        $messenger = $app->messenger;

        // 准备消息
        $message = new TextCard([
            'title' => '你的请假单审批通过',
            'description' => "时间：".date('Y-m-d H:i')."\r\n内容：您的请假审批已通过，请查阅！",
            'url' => 'http://test.xuzhaowen.cn'
        ]);
        $result = $messenger->message($message)->toUser('XuZhaoWen')->ofAgent(env('WECHAT_WORK_AGENT_ID'))->send();
        dd($result);

        $result = $messenger->toUser('XuZhaoWen')->ofAgent(env('WECHAT_WORK_AGENT_ID'))->send('hello ！');
        dd($result);
    }
}
