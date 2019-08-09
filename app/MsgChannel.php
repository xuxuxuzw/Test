<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/8/9
 * Time: 22:11
 */
namespace App;


use Illuminate\Database\Eloquent\Model;

class MsgChannel extends Model
{
    //表名
    protected $table = 'msg_channel';
    //主要
    protected $primaryKey = 'id';
}