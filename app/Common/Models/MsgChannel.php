<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/8/9
 * Time: 22:11
 */
namespace App\Common\Models;


use Illuminate\Database\Eloquent\Model;

class MsgChannel extends Model
{
    //表名
    protected $table = 'msg_channel';
    //主要
    protected $primaryKey = 'id';

    public $timestamps = false;

    // 通道类型
    const TYPE_QQ_SMS = 1; //腾讯云短信消息
    const TYPE_WECHAT_SERVICE = 2; //微信测试号消息
}