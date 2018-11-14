<?php
/**
 * Created by PhpStorm.
 * User: zhangying
 * Date: 2018/11/7
 * Time: 下午7:32
 */
namespace App\Http\Transformers;
//use Dingo\Blueprint\Annotation\Transaction;
use App\Model\BbsCategory;
use League\Fractal\TransformerAbstract;
use App\Models\User;
class UserTransformer extends TransformerAbstract{
    protected $availableIncludes = [];
    protected $defaultIncludes = [];

    public function transform(User $item)
    {
        return [
            'id' => $item->id,
            'name' => $item->name,
            'sex' => $item->sex,
            'telphone' => $item->telphone,
            'car_company'=>isset($item->car->car_company) ? $item->car->car_company : '',
            'license_plate'=>isset($item->car->license_plate) ? $item->car->license_plate : '',
            'birthday' => $item->birthday,
            'created_at'=>(string)$item->created_at,
            'first_time'=>isset($item->car->first_time) ? $item->car->first_time : '',
            'integral'=>$item->integral,
        ];
    }
}