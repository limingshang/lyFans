<?php
/**
 * Created by PhpStorm.
 * User: zhangying
 * Date: 2018/11/6
 * Time: 下午9:50
 */
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Dingo\Api\Routing\Helpers;

class BaseController extends Controller{
    use Helpers;
    public function success($data = [])
    {
        return response()->json([
            'status'  => true,
            'code'    => 200,
            'message' => config('errorcode.code')[200],
            'data'    => $data,
        ]);
    }

    public function fail($code, $data = [])
    {
        return response()->json([
            'status'  => false,
            'code'    => $code,
            'message' => config('errorcode.code')[(int) $code],
            'data'    => $data,
        ]);
    }
}