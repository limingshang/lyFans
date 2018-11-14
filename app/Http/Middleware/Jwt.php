<?php

namespace App\Http\Middleware;

use Closure;

class Jwt
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // # 过滤内网
        // $ip = $request->getClientIp();
        // # 获取IP白名单
        // $white_list = explode(',', env('WHITE_HOST'));
        // if (!in_array($ip, $white_list)) {
        //     return Responser::error(403);
        // }
//        try {
//            $token = $this->auth->setRequest($request)->getToken();
//            // dd($token);
//            // $user = $this->auth->parseToken()->authenticate();
//            $user = $this->auth->toUser($token);
//            dd($user);
//        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
//            return Responser::error(402);
//        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
//            try {
//                $token = $this->auth->getToken()->get();//验证是否能获取到token
//                $newToken = auth()->refresh();
//            } catch (\Exception $e) {
//                return Responser::error($e->getMessage());
//            }
//            #刷新token并且返回新token
//            return Responser::error(406,[
//                'newToken' => $newToken
//            ]);
//        } catch (JWTException $e) {
//            return Responser::error(402);
//        }
//
//        dd('66');
//        return $next($request);
    }
}
