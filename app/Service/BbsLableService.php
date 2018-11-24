<?php
/**
 * Created by PhpStorm.
 * User: zhangying
 * Date: 2018/11/24
 * Time: 上午8:04
 */
namespace App\Service;
use App\Model\Bbs\BbsLable;
use App\Utils\PagingHelper;
class BbsLableService extends BaseAbstractService{
    public function getList($page,$limit){
        try{
            $paging = new PagingHelper(BbsLable::getList()->count(),$limit,$page);
            $list = BbsLable::getList()->forPage($paging->page,$paging->limit);
            return $list;
        }catch (\Exception $e){
            return false;
        }
    }

    public function add($info){
        try {
            if (BbsLable::fetchByName('0',$info['label_name'])==false){
                $res = BbsLable::createLable($info);
                if($res){
                    return ['code'=>1,'message'=>'新增成功'];
                }else{
                    return ['code'=>0,'message'=>'新增失败'];
                }
            }else{
                return ['code'=>0,'message'=>'存在同名标签'];
            }
        }catch (\Exception $e) {
            return ['code'=>0,'message'=>'新增失败'];
        }
    }

    public function edit($info,$id){
        try{
            if (BbsLable::fetchByName($id,$info['label_name'])==false){
                $res = BbsLable::updateLabel($info,$id);
                if($res){
                    return ['code'=>1,'message'=>'修改成功'];
                }else{
                    return ['code'=>0,'message'=>'修改失败'];
                }
            }else{
                return ['code'=>0,'message'=>'存在同名标签'];
            }
        }catch (\Exception $e){
            return ['code'=>0,'message'=>'修改失败'];
        }
    }
}