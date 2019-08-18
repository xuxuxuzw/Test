<?php

namespace App\Common\Logics;


use App\Common\ErrorCode;

class BaseLogic
{
    /**
     * 抛出异常
     * @param $error_code
     * @param string $error_msg
     * @throws \Exception
     */
    protected function throwException($error_code, $error_msg = '')
    {
        if (is_array($error_msg)) {
            $msg_arr = $error_msg;
            $error_msg = $msg_arr[0] . ErrorCode::getMessage($error_code) . $msg_arr[1];
        } else {
            empty($error_msg) && $error_msg = ErrorCode::getMessage($error_code);
        }
        throw new \Exception($error_msg, $error_code);
    }
}


