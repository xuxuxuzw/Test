<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/8/9
 * Time: 22:21
 */

namespace App\Common\Repositories;

use App\Common\Models\MsgChannel;
use App\Common\Repositories\BaseRepository;
use App\Common\Models\MsgContent;

class MsgContentRepositories extends BaseRepository
{
    protected $msg_content;

    public function __construct()
    {
        $this->msg_content = new MsgContent();
    }

    public function getMsgContent($id)
    {
        return $this->msg_content->where('id', $id)->first()->toArray();
    }

    public function getMsgContents($where = [['status', MsgContent::STATUS_UNSENT]])
    {
        return $this->msg_content->where($where)->orderBy('id','asc')->get()->toArray();
    }

    public function addMsgContent($params)
    {
        $data = [];
        $data['msg_channel_id'] = $params['msg_channel_id'];
        $data['msg_template_id'] = $params['msg_template_id'];
        $data['cp_msg_type'] = $params['cp_msg_type'];
        $data['cp_msg_channel_type'] = $params['cp_msg_channel_type'];
        $data['cp_template_no'] = $params['cp_template_no'];
        $data['cp_out_template_no'] = $params['cp_out_template_no'];
        $data['receiver_name'] = !empty($params['receiver_name']) ? $params['receiver_name'] : '';
        $data['receiver_source_id'] = $params['receiver_source_id'];
        $data['content'] = !empty($params['content']) ? $params['content'] : '';
        $data['params'] = !empty($params['params']) ? (is_array($params['params']) ? json_encode($params['params']) : $params['params']) : '[]';
        $data['status'] = !empty($params['status']) ? $params['status'] : MsgContent::STATUS_UNSENT;
        $data['channel_return_msg'] = $params['channel_return_msg'];
        $data['create_time'] = time();
        $data['update_time'] = time();

        return $this->msg_content
            ->insertGetId($data);
    }

    public function updateMsgContent($condition, $params)
    {
        return $this->msg_content
            ->where($condition)
            ->update($params);
    }


}