<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/8/18
 * Time: 10:10
 */

namespace App\Modules\Common\Http\Controllers;

use App\Modules\Common\Http\Logics\UploadLogic;
use Illuminate\Http\Request;

class UploadControllers extends Controllers
{
    protected $upload_logic;

    public function __construct()
    {
        $this->upload_logic = new UploadLogic();
    }

    public function file(Request $request)
    {
        try {
            $data = $this->upload_logic->file($request);
            return $this->response($data);
        } catch (\Exception $e) {
            $this->getExceptionError($e);
        }
    }

    public function files(Request $request)
    {
        try {
            $data = $this->upload_logic->files($request);
            return $this->response($data);
        } catch (\Exception $e) {
            $this->getExceptionError($e);
        }
    }

    public function image(Request $request)
    {
        try {
            $data = $this->upload_logic->image($request);
            return $this->response($data);
        } catch (\Exception $e) {
            $this->getExceptionError($e);
        }
    }

    public function images(Request $request)
    {
        try {
            $data = $this->upload_logic->images($request);
            return $this->response($data);
        } catch (\Exception $e) {
            $this->getExceptionError($e);
        }
    }
}