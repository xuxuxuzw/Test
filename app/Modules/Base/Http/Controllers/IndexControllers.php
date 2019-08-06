<?php

namespace App\Modules\Base\Http\Controllers;

use App\Http\Controllers\Controller;

class IndexControllers extends Controller
{
    public function index()
    {
        echo 'sss';
        return view('base::Index.index');
    }
}