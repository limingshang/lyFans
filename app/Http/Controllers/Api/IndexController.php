<?php
/**
 * Created by PhpStorm.
 * User: zhangying
 * Date: 2018/11/6
 * Time: 下午9:48
 */
namespace App\Http\Controllers\Api;


class IndexController extends BaseController {
    public function index(){
        $error = 1;
        if($error){
            return ['status'=>'error','message'=>'未通过验证'];
//            return ['status'=>'error','message'=>'未通过验证'];　　　　//返回200响应码，但是返回status为error的标识

        }
        return ['status'=>'success','message'=>'通过验证'];
//        return ['status'=>'success','message'=>'操作成功'];　　　　　　//返回200响应码，并且返回status为success的标识
    }
}