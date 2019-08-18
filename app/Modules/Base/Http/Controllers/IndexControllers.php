<?php

namespace App\Modules\Base\Http\Controllers;

class IndexControllers extends Controllers
{
    public function index()
    {
        echo 'sss';
        return view('base::Index.index');
    }
}