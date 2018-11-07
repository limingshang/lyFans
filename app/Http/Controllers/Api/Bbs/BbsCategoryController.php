<?php
/**
 * Created by PhpStorm.
 * User: zhangying
 * Date: 2018/11/7
 * Time: 下午8:21
 */
namespace App\Http\Controllers\Api\Bbs;
use App\Http\Controllers\Controller;
use App\Service\BbsCategoryService;

class BbsCategoryController extends Controller{
    public function index(){
        //接收数据层
        $bbsCategroyServive = BbsCategoryService::singleton();
        $result = $bbsCategroyServive->index();
    }
}