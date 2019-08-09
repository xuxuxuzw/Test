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
use App\Common\Models\MsgTemplate;

class MsgTemplateRepositories extends BaseRepository
{
    protected $msg_template;

    public function __construct()
    {
        $this->msg_template = new MsgTemplate();
    }

    public function getMsgTemplate($id)
    {
        $msg_template = $this->msg_template->where('id', $id)->first()->toArray();
        if (!empty($msg_template)) {
            $msg_template['channel'] =(new MsgChannelRepositories())->getMsgChannel($msg_template['msg_channel_id']);
            $msg_template['content'] = htmlspecialchars_decode($msg_template['content']);
        }

        return $msg_template;

        return $this->msg_template->where('id', $id)->first()->toArray();
    }

    public function addMsgTemplate($params)
    {
        return $this->msg_template
            ->insertGetId($params);
    }

    public function updateMsgTemplate($condition, $params)
    {
        return $this->msg_template
            ->where($condition)
            ->update($params);
    }

    /**
     * 使用参数填充消息模板
     * User zhongronglin@3ncto.com
     * @param string $channel_id 消息通道id
     * @param string $template_content
     * @param array $template_params 模板变量的键值对
     * @return string
     */
    public function fillTemplate($channel_id, $template_content, $template_params = [])
    {
        if (empty($channel_id) || empty($template_content) || empty($template_params) || !is_array($template_params)) return $template_content;

        $channel = (new MsgChannelRepositories())->getMsgChannel($channel_id);
        if (empty($channel)) return $template_content;

        foreach ($template_params as $key => $value) {
            //微信模板消息需要加上 .DATA
            if (in_array($channel['type'], [
                MsgChannel::TYPE_WECHAT_SERVICE,
            ])) {
                $placeholder = $channel['left_delimiter'] . $key . '.DATA' . $channel['right_delimiter'];
            } else {
                $placeholder = $channel['left_delimiter'] . $key . $channel['right_delimiter'];
            }

            $template_content = str_replace($placeholder, $value, $template_content);
        }

        return $template_content;
    }
}