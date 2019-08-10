<?php
/**
 * Created by PhpStorm.
 * User: echo
 * Date: 2018/11/23
 * Time: 11:26
 */

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\User;

class WechatController extends Controller
{
    //微信验证
    public function index()
    {
        $app = app('wechat');
        $response = $app->server->serve();
        return $response;
    }
    public function redirect(Request $request)
    {
        $app = app('wechat.official_account');
        return $app->oauth->scopes(['snsapi_base'])
            ->setRequest($request)
            ->redirect();
    }

    public function callback(Request $request)
    {
        $app = app('wechat.official_account');
        $user = $app->oauth->setRequest($request)->user();
        $original = $user->getOriginal();

        $array = array_only($original,array (
            'openid',
        ));

        $openId = $array['openid'];

        $user = User::where('openid',$openId)->first();
        if($user){
            \Auth::login($user);
        }else{
            $userNew = User::create($array);
            \Auth::login($userNew);
        }
        return redirect()->intended('/home');

    }

    public function jsConfig()
    {
        $app = app('wechat.official_account');
        $js = $app->jssdk;
        if(request()->url){
            $js->setUrl(request()->url);
        }

        $jsConfig = json_decode($js->buildConfig(array('updateAppMessageShareData', 'updateTimelineShareData','onMenuShareAppMessage','onMenuShareTimeline','onMenuShareAppMessage','getLocation','openLocation'),true));
        return json_encode(['errorCode'=>0,'errorMsg'=>'ok','data'=>['js_config'=>$jsConfig]]);
    }
}
