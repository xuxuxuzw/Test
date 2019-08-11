<?php
/**
 * Created by PhpStorm.
 * User: xzw
 * Date: 2019/8/7
 * Time: 22:54
 */

namespace App\Http\Controllers\Api\V1;

use App\Common\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    use Helpers;

    public function login(Request $request)
    {

        $data = $request->only('email', 'password');
        /*User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        exit;*/
        if (!($token = auth('api')->attempt($data))) {
            return $this->response->array([
                'code' => 40000, 'msg' => 'email or password error'
            ]);
        }
        return $this->response->array([
            'code' => '200', 'token' => $token
        ]);
    }
}