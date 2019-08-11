<?php
/**
 * Created by PhpStorm.
 * User: echo
 * Date: 2018/11/23
 * Time: 11:26
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Common\Models\User;
use EasyWeChat\Factory;

class IndexWechatController extends BaseWechatController
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
                'callback' => '/wechat/index/callback',
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
        return redirect()->intended('/index');
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
