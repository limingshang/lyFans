<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CommonModel extends Model
{
    // 定义删除状态
    const IS_DELETE     = 1;
    const IS_UNDELETED  = 0;
    // 修改增加时间修改为时间戳格式
    public $timestamps = true;
    // 定义主键
    protected $primaryKey  = 'id';
    // key
    protected static $key       = '';
    // 字段
    protected static $fields    = [];
    // 删除标记
    protected static $isDelete  = self::IS_UNDELETED;
    // 关键字
    protected static $keywords  = [
        'where',
        'orWhere',
        'whereBetween',
        'whereNotBetween',
        'whereIn',
        'whereNotIn',
        'whereNull',
        'whereNotNull',
        'select',
    ];
    /**
     * 获取当前时间
     *
     * @return int
     */
    public function freshTimestamp() {
        return time();
    }

    /**
     * 避免转换时间戳为时间字符串
     *
     * @param DateTime|int $value
     * @return DateTime|int
     */
    public function fromDateTime($value) {
        return $value;
    }

    /**
     * select的时候避免转换时间为Carbon
     *
     * @param mixed $value
     * @return mixed
     */
//  protected function asDateTime($value) {
//	  return $value;
//  }

    /**
     * 从数据库获取的为获取时间戳格式
     *
     * @return string
     */
    public function getDateFormat() {
        return 'U';
    }
    /**
     * 获取Model
     * @param $condition
     *
     * @return object
     */
    protected static function getModel($condition)
    {
        $model       = new static();
        // 关键字
        foreach (static::$keywords as $keyword) {
            if (isset($condition[$keyword])) {
                switch ($keyword) {
                    case 'where':
                    case 'orWhere':
                    case 'whereNull':
                    case 'whereNotNull':
                        $model = $model->$keyword($condition[$keyword]);
                        break;
                    case 'whereBetween':
                    case 'whereNotBetween':
                    case 'whereIn':
                    case 'whereNotIn':
                        $model = $model->$keyword($condition[$keyword][0], $condition[$keyword][1]);
                        break;
                    case 'select':
                        $model = call_user_func_array([$model, $keyword], $condition[$keyword]);
                        break;
                    default:
                        break;
                }
            }
        }
        // 表字段
        foreach (static::$fields as $field) {
            if (isset($condition[$field])) {
                $model = $model->where($field, $condition[$field]);
            }
        }
        return $model;
    }
    /**
     * 获取列表
     * @param $condition
     * @param $columns
     * @param $orderBy
     *
     * @return array
     */
    public static function getList($condition = [], $columns = [], $orderBy = [], $limit = '', $skip = '')
    {
        $model = static::getModel($condition);
        if ($limit && $skip) {
            $model->limit($limit)->skip($skip);
        }
        if ($orderBy) {
            $model->orderby($orderBy[0], $orderBy[1]);
        }
        $list  = $model->get($columns);
        if ($list) {
            $list = $list->toArray();
        }
        return $list;
    }
    /**
     * 获取详情
     * @param $condition
     * @param $columns
     * @param $orderBy
     *
     * @return array
     */
    public static function getDetail($condition, $columns = ['*'], $orderBy = [])
    {
        $model  = static::getModel($condition);
        if ($orderBy) {
            foreach($orderBy as $key => $value){
                $model->orderby($key, $value);
            }

        }
        $detail = $model->first($columns);
        debug($detail);
        if ($detail) {
            $detail = $detail->toArray();
        }
        return $detail;
    }
    /**
     * 获取数量
     * @param $condition
     *
     * @return int
     */
    public static function getCount($condition)
    {
        $model = static::getModel($condition);
        $count = $model->count();
        return $count;
    }
    /**
     * 删除
     * @param $condition
     *
     * @return bool
     */
    public static function del($condition)
    {
        $model = static::getModel($condition);
        $del   = $model->delete();
        return $del;
    }
    /**
     * 软删除
     * @param $condition
     *
     * @return bool|int
     */
    public static function softDel($condition)
    {
        if (!static::$isDeleted) {
            return null;
        }
        $model  = static::getModel($condition);
        $result = $model->update([static::$isDeleted => static::IS_DELETED,]);
        return $result;
    }
    /**
     * 编辑|新建 详情
     * @param $editData
     * @param $condition
     *
     * @return int
     */
    public static function edit($condition = null, $editData)
    {
        $key          = static::$key;
        $model        = new static();
        if ($condition) {
            $detail = static::getDetail($condition);
            if ($detail) {
                $model = static::where($key, $detail[$key])->first();
            }
        }
        $editKey = static::$fields;
        self::bind($model, $editKey, $editData);
        $model->save();
        return $model->$key;
    }
    /**
     * Model 绑定数据
     */
    public static function bind(&$model, $editKey, $editData) {
        foreach ($editKey as $val) {
            if (isset($editData[$val])) {
                $setValue = $editData[$val];
                if (is_array($setValue)) {
                    $setValue = json_encode($setValue);
                }
                $model->$val = trim($setValue,' ');
            }
        }
    }
}
