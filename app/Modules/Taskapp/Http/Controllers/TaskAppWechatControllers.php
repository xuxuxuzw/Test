<?php
/**
 * Created by PhpStorm.
 * User: echo
 * Date: 2018/11/23
 * Time: 11:26
 */

namespace App\Modules\TaskApp\Http\Controllers;

use App\Http\Controllers\BaseWechatController;
use Illuminate\Http\Request;
use App\Common\Models\User;
use EasyWeChat\Factory;

class TaskAppWechatControllers extends BaseWechatController
{
    public function getUserInfo(Request $request)
    {
        $code = $request->get('code');
        $app = $this->getProgramApp();
        $data = $app->auth->session($code);
        return $data;
    }
}
