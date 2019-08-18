<?php
/**
 * Created by PhpStorm.
 * User: echo
 * Date: 2018/11/23
 * Time: 11:26
 */

namespace App\Http\Controllers;

use App\Common\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Common\Models\User;
use EasyWeChat\Factory;

class BaseWechatController extends BaseController
{
    //获取微信公众号实例
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
                'callback' => '/wechat/callback',
            ],
        ];
        /** @var \EasyWeChat\OfficialAccount\Application $app */
        $app = Factory::officialAccount($options);
        return $app;
    }

    //获取微信小程序实例
    public function getProgramApp()
    {
        $config = [
            'app_id' => env('WECHAT_MINI_PROGRAM_APPID'),
            'secret' => env('WECHAT_MINI_PROGRAM_SECRET'),

            // 下面为可选项
            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',

            'log' => [
                'level' => env('WECHAT_LOG_LEVEL'),
                'file' => storage_path(env('WECHAT_LOG_FILE')),
            ],
        ];
        /** @var \EasyWeChat\MiniProgram\Application $app */
        $app = Factory::miniProgram($config);
        return $app;
    }

    //获取企业微信实例
    public function getWorkApp()
    {
        $config = [
            'corp_id' => env('WECHAT_WORK_CORP_ID'),
            'agent_id' => env('WECHAT_WORK_AGENT_ID'), // 如果有 agend_id 则填写
            'secret' => env('WECHAT_WORK_AGENT_CONTACTS_SECRET'),

            // 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
            'response_type' => 'array',

            'log' => [
                'level' => env('WECHAT_LOG_LEVEL'),
                'file' => storage_path(env('WECHAT_LOG_FILE')),
            ],
        ];
        /** @var \EasyWeChat\Work\Application $app */
        $app = Factory::work($config);
        return $app;
    }


    //微信验证
    public function index()
    {
        $app = $this->getApp();
        //$app = app('wechat.official_account');
        $response = $app->server->serve();
        return $response;
    }

    public function redirect(Request $request)
    {
        $app = $this->getApp();
        //$app = app('wechat.official_account'); //snsapi_userinfo
        return $app->oauth->scopes(['snsapi_base'])
            ->setRequest($request)
            ->redirect();
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
}
