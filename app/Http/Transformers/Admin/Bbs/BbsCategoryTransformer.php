<?php
/**
 * Created by PhpStorm.
 * User: zhangying
 * Date: 2018/11/8
 * Time: 下午7:24
 */
namespace App\Http\Transformers\Admin\Bbs;
use League\Fractal\TransformerAbstract;

class BbsCategoryTransformer extends TransformerAbstract{
    protected $availableIncludes = [];
    protected $defaultIncludes = [];

    public function transform(BbsCategory $info)
    {
        return [
            'id' => $info->id,
            'name' => $info->category_name,
            'status'=> $info->status,
            'updated_at' => $info->updated_at,
            'created_at' => $info->created_at,
        ];
    }

}