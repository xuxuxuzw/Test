<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/5/4
 * Time: 20:55
 */

namespace App\Common\Services;

use App\Common\Models\MsgContent;
use App\Common\Repositories\MsgChannelRepositories;
use App\Common\Repositories\MsgContentRepositories;
use App\Common\Repositories\MsgTemplateRepositories;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class MsgService
{
    protected $msg_channel_repositories;
    protected $msg_template_repositories;
    protected $msg_content_repositories;

    public function __construct()
    {
        $this->msg_channel_repositories = new MsgChannelRepositories();//消息通道

        $this->msg_template_repositories = new MsgTemplateRepositories();//消息模板

        $this->msg_content_repositories = new MsgContentRepositories();//消息内容
    }

    /**
     * 推送消息
     * @param string $template_id 内部模板ID
     * @param array $receiver_data 消息接收者信息 [
     *      int receiver_id 消息接收者ID
     *      string receiver_name 消息接收者内部名称
     *      string|array receiver_source_id 消息接收者消息通道识别ID（支持单个/多个）
     * ]
     * @param array $template_params 模板参数的键值对
     * @param array $send_content_params 已发送内容
     * @return false|array 以['id' => 消息id, 'message_no' => 消息编号]为结构的二维数组
     */
    public function push($template_id, $receiver_data = [], $template_params = [], $send_content_params = [])
    {
        $msg_template = $this->msg_template_repositories->getMsgTemplate($template_id);

        $receiver_source_ids = [];
        if (!empty($receiver_data['receiver_source_id'])) {
            $receiver_source_ids[] = $receiver_data['receiver_source_id'];
        } elseif (!empty($receiver_data['receiver_source_ids'])) {
            if (is_array($receiver_data['receiver_source_ids'])) {
                $receiver_source_ids = $receiver_data['receiver_source_ids'];
            } else {
                $receiver_source_ids = explode(',', $receiver_data['receiver_source_ids']);
            }
        } elseif (!empty($msg_template['receiver_source_ids'])) {
            $receiver_source_ids = explode(',', $msg_template['receiver_source_ids']);
        }
        if (empty($receiver_source_ids)) {
            throw new \Exception('消息接收者参数不能为空', -1);
        }

        $messages = [];
        foreach ($receiver_source_ids as $receiver_source_id) {
            $message = $this->msg_content_repositories->addMsgContent([
                'msg_channel_id' => $msg_template['msg_channel_id'],
                'msg_template_id' => $msg_template['id'],
                'cp_msg_type' => $msg_template['msg_type'],
                'cp_msg_channel_type' => $msg_template['channel']['type'],
                'cp_template_no' => $msg_template['template_no'],
                'cp_out_template_no' => !empty($msg_template['out_template_no']) ? $msg_template['out_template_no'] : '',
                'receiver_name' => !empty($receiver_data['receiver_name']) ? $receiver_data['receiver_name'] : '',
                'receiver_source_id' => $receiver_source_id,
                'content' => $this->msg_template_repositories->fillTemplate($msg_template['msg_channel_id'], $msg_template['content'], $template_params),
                'params' => $template_params,
                'status' => !empty($send_content_params['status']) ? $send_content_params['status'] : MsgContent::STATUS_UNSENT,
                'channel_return_msg' => !empty($send_content_params['channel_return_msg']) ? $send_content_params['channel_return_msg'] : '',
            ]);
            if (empty($message)) {
                Log::write("发送失败，消息模板（编号：{$template_id}），消息参数为:" . json_encode($template_params), Log::ERR);
                $messages[] = ['id' => $message, 'message_no' => '发送失败'];
                continue;
            } else {
                $messages[] = ['id' => $message, 'message_no' => '发送成功'];
            }
        }

        return $messages;
    }

}