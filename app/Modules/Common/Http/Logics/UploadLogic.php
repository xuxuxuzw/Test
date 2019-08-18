<?php

namespace App\Modules\Common\Http\Logics;

use App\Common\Logics\BaseLogic;
use App\Common\Services\UploadService;
use Illuminate\Http\Request;

/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/8/18
 * Time: 15:38
 */
class UploadLogic extends BaseLogic
{
    protected $upload_services;

    public function __construct()
    {
        $this->upload_services = new UploadService();
    }

    public function file(Request $request)
    {
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $white_file_type = config('enum.upload.white_file_type');
            $file = $request->file('file');
            $output = $this->upload_services->file($file, $white_file_type);
            return $output;
        } else {
            $this->throwException(\App\Common\ErrorCode::SYS_REQUEST_METHOD_ERROR, '未获取到上传文件或上传过程出错');
        }
    }

    public function files(Request $request)
    {
        $response = [];
        if ($request->hasFile('files')) {
            $white_file_type = config('enum.upload.white_file_type');
            foreach ($request->file('files') as $file) {
                $response[] = $this->upload_services->file($file, $white_file_type);
            }
        } else {
            $this->throwException(\App\Common\ErrorCode::SYS_REQUEST_METHOD_ERROR, '未获取到上传文件或上传过程出错');
        }
        return $response;
    }

    public function image(Request $request)
    {
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $white_image_type = config('enum.upload.white_image_type');
            $file = $request->file('image');
            $output = $this->upload_services->image($file, $white_image_type);
            return $output;
        } else {
            $this->throwException(\App\Common\ErrorCode::SYS_REQUEST_METHOD_ERROR, '未获取到上传图片或上传过程出错');
        }
    }


    public function images(Request $request)
    {
        $response = [
            'page_no' => $request->get('page_no', 1),
            'page_num' => $request->get('page_size', 0),
            'count' => 0,
            'data_list' => null,
        ];
        $data_list = [];
        if ($request->hasFile('images')) {
            $white_image_type = config('enum.upload.white_image_type');
            foreach ($request->file('images') as $file) {
                $data_list[] = $this->upload_services->image($file, $white_image_type);
            }
        } else {
            $this->throwException(\App\Common\ErrorCode::SYS_REQUEST_METHOD_ERROR, '未获取到上传图片或上传过程出错');
        }
        $response['data_list'] = $data_list;
        $response['count'] = count($data_list);
        return $response;
    }

}