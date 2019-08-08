<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/5/4
 * Time: 20:55
 */

namespace App\Services;

use Illuminate\Support\Facades\Mail;

class MailService
{
    protected $email;

    //在这里传入内部模版ID,和params参数，和发送者数组
    public function __construct()
    {
    }

    public function sendMsg($emails = ['1315915745@qq.com'])
    {
        $title = "队列测试";
        $result = [];
        foreach ($emails as $e) {
            $this->email = $e;
            Mail::raw('队列测试', function ($message) {
                $message->to($this->email);
            });
        }
        return json_decode($result, true);
    }
}