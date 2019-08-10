<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/8/9
 * Time: 22:11
 */
namespace App\Common\Models;


use Illuminate\Database\Eloquent\Model;

class MsgTemplate extends Model
{
    //表名
    protected $table = 'msg_template';
    //主要
    protected $primaryKey = 'id';

    public $timestamps = false;
}