<?php
/**
 * Created by PhpStorm.
 * User: zhangying
 * Date: 2018/11/7
 * Time: 下午9:10
 */
namespace App\Model;
/**
 * Class BbsCategory    帖子分类表
 * @package App\Model
 * @property int        $id
 * @property string     $category_name      分类名称
 * @property int        $admin_uid          后台操作人员
 * @property TIMESTAMP  $created_at         创建时间
 * @property TIMESTAMP  $updated_at         更新时间
 */
class BbsCategory extends BaseAbstractModel{
    /**
     * 与模型关联的数据表
     *
     * @var string
     */
    protected $table = 'bbs_category';

    protected $fillable = [
        'id','category_name','admin_uid','admin_uid','created_at','updated_at'
    ];

    public static function fetchByAdminUid($admin_uid){
        return self::where('admin_uid',$admin_uid)->orderBy('id','desc')->get();
    }
}