<?php
/**
 * Created by PhpStorm.
 * User: zhangying
 * Date: 2018/11/7
 * Time: 下午9:11
 */
namespace App\Model;

use Illuminate\Database\Eloquent\Model;

abstract class BaseAbstractModel extends Model
{
    // 使用软删除
    // use SoftDeletes;

    /**
     * 定义 model 的主键
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * 此模型的连接名称。
     *
     * @var string
     */
    protected $connection = 'linghou';

    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;

    //    /**
    //     * 与模型关联的数据默认字段
    //     *
    //     * @var array
    //     */
    //    const global_fillable = [
    //        'id',
    //        'deleted_at',
    //        'created_at',
    //        'updated_at',
    //    ];

    /*
     * 格式化输出的 created 时间
     */
    public function getCreatedAtAttribute($value)
    {
        return empty($value) ? null : date("Y-m-d H:i:s", $value);
    }

    /*
     * 格式化输出的 updated 时间
     */
    public function getUpdatedAtAttribute($value)
    {
        return empty($value) ? null : date("Y-m-d H:i:s", $value);
    }

    /*
     * 格式化输出的 deleted 时间
     */
    public function getDeletedAtAttribute($value)
    {
        return empty($value) ? null : date("Y-m-d H:i:s", $value);
    }
}
