<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     * 要求附带email和password（数据来源users表）
     *
     * @return void
//     */
//    public function __construct()
//    {
//        // 这里额外注意了：官方文档样例中只除外了『login』
//        // 这样的结果是，token 只能在有效期以内进行刷新，过期无法刷新
//        // 如果把 refresh 也放进去，token 即使过期但仍在刷新期以内也可刷新
//        // 不过刷新一次作废
//        $this->middleware('auth:api', ['except' => ['login']]);
//        // 另外关于上面的中间件，官方文档写的是『auth:api』
//        // 但是我推荐用 『jwt.auth』，效果是一样的，但是有更加丰富的报错信息返回
//    }
//
//    /**
//     * Get a JWT via given credentials.
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function login()
//    {
//        $credentials = request(['email', 'password']);
//
//        if (! $token = auth('api')->attempt($credentials)) {
//            return response()->json(['error' => 'Unauthorized'], 401);
//        }
//
//        return $this->respondWithToken($token);
//    }
//
//    /**
//     * Get the authenticated User.
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function me()
//    {
//        return response()->json(auth('api')->user());
//    }
//
//    /**
//     * Log the user out (Invalidate the token).
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function logout()
//    {
//        auth('api')->logout();
//
//        return response()->json(['message' => 'Successfully logged out']);
//    }
//
//    /**
//     * Refresh a token.
//     * 刷新token，如果开启黑名单，以前的token便会失效。
//     * 值得注意的是用上面的getToken再获取一次Token并不算做刷新，两次获得的Token是并行的，即两个都可用。
//     * @return \Illuminate\Http\JsonResponse
//     */
//    public function refresh()
//    {
//        return $this->respondWithToken(auth('api')->refresh());
//    }
//
//    /**
//     * Get the token array structure.
//     *
//     * @param  string $token
//     *
//     * @return \Illuminate\Http\JsonResponse
//     */
//    protected function respondWithToken($token)
//    {
//        return response()->json([
//            'access_token' => $token,
//            'token_type' => 'bearer',
//            'expires_in' => auth('api')->factory()->getTTL() * 60
//        ]);
//    }

    /**
     * Get a JWT token via given credentials.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
//    public function login(Request $request)
//    {
//        // 验证规则，由于业务需求，这里我更改了一下登录的用户名，使用手机号码登录
//        $rules = [
//            'mobile'   => [
//                'required',
//                'exists:users',
//            ],
//            'password' => 'required|string|min:6|max:20',
//        ];
//        $user = User::where('mobile', $request->mobile)->first();
//        // 验证参数，如果验证失败，则会抛出 ValidationException 的异常
//        $params = $this->validate($request, $rules);
//        // 使用 Auth 登录用户，如果登录成功，则返回 201 的 code 和 token，如果登录失败则返回
////        if($user && Hash::check($request->get('password'), $user->password)){
////            $token = JWTAuth::fromUser($user);
////            return response(['token' => 'bearer ' . $token], 201);
////        }else{
////            return response(['error' => '账号或密码错误'], 400);
////        }
//        return ($token = Auth::guard('api')->attempt($params))
//            ? response(['token' => 'bearer ' . $token], 201)
//            : response(['error' => '账号或密码错误'], 400);
//    }
    public function authLogin(Request $request)
    {
        $params = $request->params;
        // dd($params);
        try {
            $admin_data = $this->authService->get_admin_info($params['mobile'], $params['password']);
            #生成token
            $token = $this->auth->fromUser($admin_data);
            // dd($token);
            return Responser::success([
                'token' => $token,
                'expires_in' => $this->auth->factory()->getTTL() * 60,
                'userinfo' => $admin_data->toArray()
            ]);
        }catch (\Exception $e) {
            return Responser::error($e->getMessage());
        }
    }
    /**
     * 处理用户登出逻辑
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        Auth::guard('api')->logout();

        return response(['message' => '退出成功']);
    }
}
