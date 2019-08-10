<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/8/9
 * Time: 22:21
 */

namespace App\Common\Repositories;

use App\Common\Repositories\BaseRepository;
use App\Common\Models\MsgChannel;

class MsgChannelRepositories extends BaseRepository
{
    protected $msg_channel;

    public function __construct()
    {
        $this->msg_channel = new MsgChannel();
    }
    
    public function getMsgChannel($id)
    {
        return $this->msg_channel->where('id', $id)->first()->toArray();
    }

    public function getMsgChannels()
    {
        return $this->msg_channel->get()->toArray();
    }

    public function addMsgChannel($params)
    {
        return $this->msg_channel
            ->insertGetId($params);
    }

    public function updateMsgChannel($condition, $params)
    {
        return $this->msg_channel
            ->where($condition)
            ->update($params);
    }
}