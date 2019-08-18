<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/8/18
 * Time: 15:50
 */

namespace App\Common\Services;

use App\Common\Services\BaseService;

class UploadService extends BaseService
{
    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @param $white_file_type array 文件后缀白名单
     * @return array
     * @throws \Exception
     */
    public function file(\Illuminate\Http\UploadedFile $file, $white_file_type)
    {
        //原文件名
        $file_type = $file->extension();//文件类型
        $extension = $file->getClientOriginalExtension();//文件后缀
        //文件类型校验白名单
        if (!in_array(strtolower($extension), $white_file_type)) {
            $this->throwException(\App\Common\ErrorCode::SYS_REQUEST_METHOD_ERROR, '无法上传该文件类型');
        }
        $original_name = $file->getClientOriginalName();
        $new_file_name = date('YmdHis') . '-' . md5(time()) . '.' . $extension;//新文件名
        $date_path = date('Y-m-d');//日期目录
        $save_path = 'public/files/' . $date_path;//上传目录
        $use_path = '/storage/files/' . $date_path . '/' . $new_file_name;//软链接，使用目录
        $real_path = $file->storeAs($save_path, $new_file_name);
        $output = [
            'extension' => $extension,
            'real_path' => $real_path,
            'use_path' => $use_path,
            'original_name' => $original_name,
        ];
        return $output;
    }


    /**
     * @param \Illuminate\Http\UploadedFile $file
     * @param $white_file_type array 图片后缀白名单
     * @return array
     * @throws \Exception
     */
    public function image(\Illuminate\Http\UploadedFile $file, $white_image_type)
    {
        //原文件名
        $file_type = $file->extension();//文件类型
        $extension = $file->getClientOriginalExtension();//文件后缀
        //文件类型校验白名单
        if (!in_array(strtolower($extension), $white_image_type)) {
            $this->throwException(\App\Common\ErrorCode::SYS_REQUEST_METHOD_ERROR, '无法上传该图片类型');
        }
        $original_name = $file->getClientOriginalName();
        $new_file_name = date('YmdHis') . '-' . md5(time()) . '.' . $extension;//新文件名
        $date_path = date('Y-m-d');//日期目录
        $save_path = 'public/images/' . $date_path;//上传目录
        $use_path = '/storage/images/' . $date_path . '/' . $new_file_name;//软链接，使用目录
        $real_path = $file->storeAs($save_path, $new_file_name);
        $output = [
            'extension' => $extension,
            'real_path' => $real_path,
            'use_path' => $use_path,
            'original_name' => $original_name,
        ];
        return $output;
    }
}