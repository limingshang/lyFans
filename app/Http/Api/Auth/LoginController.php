<?php

namespace App\Http\Api\Auth;

use App\Model\User;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Facades\JWTAuth;


class LoginController extends Controller
{
    //
    use AuthenticatesUsers;
    use Helpers;

    public function login(Request $request){

        $user = User::where('mobile', $request->mobile)->orWhere('name', $request->mobile)->first();

        if($user && Hash::check($request->get('password'), $user->password)){
            $token = JWTAuth::fromUser($user);
            return $this->sendLoginResponse($request, $token);
        }

        return $this->sendFailedLoginResponse($request);
    }

    public function sendLoginResponse(Request $request, $token){
        $this->clearLoginAttempts($request);

        return $this->authenticated($token);
    }

    public function authenticated($token){
        return $this->response->array([
            'token' => $token,
            'status_code' => 200,
            'message' => 'User Authenticated'
        ]);
    }

    public function sendFailedLoginResponse(){
        throw new UnauthorizedHttpException("Bad Credentials");
    }

    public function logout(){
        $this->guard()->logout();
    }
}
