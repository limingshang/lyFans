<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\CommonController;
use App\Model\CustomerModel;
use Illuminate\Http\Request;

class CustomerController extends CommonController
{
    //
    public function index(){
        $customerList = CustomerModel::getDetail();
        debug($customerList->toarray());
    }
}
