<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/5/4
 * Time: 20:57
 */

namespace App\Modules\Common\Http\Controllers;

class LoginControllers extends Controllers
{
    public function __construct()
    {
    }

    public function login(){
        return view("common::login.login");
    }
}