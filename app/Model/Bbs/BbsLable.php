<?php
/**
 * Created by PhpStorm.
 * User: zhangying
 * Date: 2018/11/24
 * Time: 上午10:06
 */
namespace App\Model\Bbs;
use App\Model\BaseAbstractModel;

/**
 * Class BbsCategory    帖子分类表
 * @package App\Model
 * @property int        $id
 * @property string     $category_name      分类名称
 * @property int        $admin_uid          后台操作人员
 * @property TIMESTAMP  $created_at         创建时间
 * @property TIMESTAMP  $updated_at         更新时间
 */
class BbsLable extends BaseAbstractModel {
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'bbs_label';

    protected $fillable = [
        'id','category_name','admin_uid','admin_uid','created_at','updated_at'
    ];

//    public static function fetchByAdminUid($admin_uid){
//        return self::where('admin_uid',$admin_uid)->orderBy('id','desc')->get();
//    }
    //获取列表
    public static function getList(){
        return self::orderBy('created_at','desc')->get();
    }
    //根据名称查询是否存在
    public static function fetchByName($id,$lable_name){
        if($id){
            $res = self::where([['id',"!=",$id],['label_name',$lable_name]])->get();
        }else{
            $res =  self::where("label_name",$lable_name)->get();
        }
        if($res->isEmpty()){
            return false;
        }else{
            return $res;
        }
    }
    //创建
    public static function createLable($info){
        $lable = new self();
        foreach ($info as $k=>$v)
            $lable->$k    = $v;
        return $lable->save();
    }
    //修改
    public static function updateLabel($info,$id){
        return self::where("id",$id)->update($info);
    }
}