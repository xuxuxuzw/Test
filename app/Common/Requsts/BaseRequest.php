<?php namespace App\Common\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

}
