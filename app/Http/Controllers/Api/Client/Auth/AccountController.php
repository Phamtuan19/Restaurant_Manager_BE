<?php

namespace App\Http\Controllers\Api\Client\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\SingInRequest;
use App\Http\Requests\Auth\SingUpRequest;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Nette\Schema\Expect;

class AccountController extends Controller
{
    //

    public function loginAccount(SingInRequest $request)
    {
        $isCheck = Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            'social_provider' => null,
        ]);

        if ($isCheck) {
            try {
                $user = User::with('roles')->where('email', $request->email)
                    ->whereNull('social_provider')
                    ->first();

                $accessToken = $this->createTooken($user);

                return Response::json([
                    'user' => $user,
                    'token' => [
                        'accessToken' => $accessToken,
                    ],
                ]);
            } catch (Expect $e) {
                return Response::json([
                    'message' => 'Tài khoản không chính xác!',
                ], 401);
            }
        }
        return Response::json([
            'message' => 'Tài khoản không chính xác!',
        ], 401);
    }

    public function singupAccount(SingUpRequest $request)
    {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => 2,
        ];

        try {
            $user = User::create($data);

            if ($user) {
                $tookenAuth = $this->createTooken($user[0]);
                return Response::json([
                    'user' => [
                        'name' => $user['name'],
                        'email' => $user['email'],
                        'image' => $user['image'],
                        'adress' => $user['adress'],
                    ],
                    'token' => $tookenAuth,
                ]);
            }
        } catch (Exception $e) {
            return Response::json([
                'status' => 403,
                'message' => 'Đăng ký thất bại!',
                'e' => $e,
            ], 200);
        }
    }

    public function logoutAccount(Request $request)
    {
        try {
            if ($request->user()->token()->revoke())
                return response()->json([
                    "message" => "Đăng xuất thành công!"
                ], 200);
        } catch (Exception $e) {
            return response()->json([
                "message" => "Đăng xuất thất bại!"
            ], 402);
        }
    }

    // get user
    public function authUser()
    {
        $user = Auth::user();
        if ($user) {
            $user = User::with('roles')->find($user->id);
            return response()->json([
                "data" => $user,
            ], 200);
        }
    }

    public function validateLogin($request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ];

        $messages = [
            'required' => ':attributes không được để trống',
            'email' => ':attributes không đúng định dạng',
            'min' => ':attributes phải lớn hơn :min ký tự',
        ];

        $attributes = [
            'email' => 'Email',
            'passsword' => 'Mật khẩu',
        ];

        $request->validate($rules, $messages, $attributes);
    }

    function createTooken($user)
    {
        if ($user) {

            $tokenResult = $user->createToken('token_auth');

            // Thiết lập Expires
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addMinutes(60);
            $token->save();
            // Trả về token
            $accessToken = $tokenResult->accessToken;
            return $accessToken;
        }
        return null;
    }
}
