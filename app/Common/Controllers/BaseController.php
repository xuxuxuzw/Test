<?php

namespace App\Common\Controllers;

use App\Common\ErrorCode;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class BaseController extends Controller
{
    use AuthenticatesUsers;


    protected function getUser()
    {
        return JWTAuth::parseToken()->authenticate();
    }

    /**
     * 根据异常信息输出错误信息
     * @param \Exception $e
     * @return void
     */
    protected function getExceptionError(\Exception $e)
    {
        $code = $e->getCode();
        // 如果异常未设置错误代码则默认为系统错误
        //new \Exception($e->getMessage(), $code ? $code : ErrorCode::SYS_SYSTEM_ERROR);
        throw new Exception($e->getMessage());
    }

    /**
     * 返回参数
     * Date 2018/5/28
     * Time 11:42
     * @param null $data
     * @param int $error_code
     * @param string $error_message
     * @return \Illuminate\Http\JsonResponse
     */
    function response($data = null, $error_code = 1, $error_message = '')
    {
        $data = empty($data) ? null : $data;
        $response = [
            'error_code' => (string)$error_code,
            'error_message' => empty($error_message) ? ErrorCode::getMessage($error_code) : $error_message,
            'data' => $data
        ];

//        if ($error_code != 1) {
//            throw new \Exception($response['error_message'], $response['error_code']);
//        }
        return response()->json($response);
    }

}


