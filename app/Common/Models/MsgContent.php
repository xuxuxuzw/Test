<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/8/9
 * Time: 22:11
 */

namespace App\Common\Models;


use Illuminate\Database\Eloquent\Model;

class MsgContent extends Model
{
    //表名
    protected $table = 'msg_content';
    //主要
    protected $primaryKey = 'id';

    const STATUS_UNSENT = 0;//未发送
}