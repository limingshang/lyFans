<?php
/**
 * Created by PhpStorm.
 * User: zhangying
 * Date: 2018/11/16
 * Time: 上午8:30
 */
namespace App\Service;
use App\User;
use Illuminate\Http\Response;

class AuthService extends BaseAbstractService{
    public function get_admin_info($mobile,$password){
        try{
            return User::where([['mobile'=>$mobile],['password']=>''])->select('id','mobile')->first();
        }catch (\Exception $e){
//            return Response::error($e->getMessage());
        }
    }
}