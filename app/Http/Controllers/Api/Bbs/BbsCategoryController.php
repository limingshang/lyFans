<?php
/**
 * Created by PhpStorm.
 * User: zhangying
 * Date: 2018/11/7
 * Time: 下午8:21
 */
namespace App\Http\Controllers\Api\Bbs;
use App\Http\Controllers\Api\BaseController;
use App\Service\BbsCategoryService;
use Illuminate\Http\Request;

class BbsCategoryController extends BaseController {
    public function getIndex(Request $request,$page,$limit){
        //接收数据层
        $bbsCategroyServive = BbsCategoryService::singleton();
        $result = $bbsCategroyServive->getList($request->uuid,$page,$limit);


    }
}