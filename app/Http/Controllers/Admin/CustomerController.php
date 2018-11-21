<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;


class CustomerController extends CommonController
{
    //
    public function index(){
        return self::returnResponseSuccess();
    }
}
