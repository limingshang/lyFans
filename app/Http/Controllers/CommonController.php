<?php

namespace App\Http\Controllers;


use App\Common\Config\CommonConst;

class CommonController extends Controller
{
    //
    public static function returnResponseSuccess($data = [])
    {
        return response()->json([
            'status'  => true,
            'code'    => 200,
            'message' => CommonConst::SUCCESS,
            'data'    => $data,
        ]);
    }

    public static function returnResponseSuccessFail($code, $data = [])
    {
        return response()->json([
            'status'  => false,
            'code'    => $code,
            'message' => config('errorcode.code')[(int) $code],
            'data'    => $data,
        ]);
    }
}
