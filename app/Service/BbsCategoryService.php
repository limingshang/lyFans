<?php
/**
 * Created by PhpStorm.
 * User: zhangying
 * Date: 2018/11/7
 * Time: 下午8:39
 */
namespace App\Service;
use App\Model\BbsCategory;
use App\Utils\PagingHelper;

class BbsCategoryService extends BaseAbstractService{

    public function getList($admin_uid,$count,$limit){
        //处理数据层，调用   model
        try{
            $paging = new PagingHelper(Award::getList($app_id)->count(),$limit);
            $list = BbsCategory::fetchByAdminUid($admin_uid);
        }catch (\Exception $e){

        }

    }
}