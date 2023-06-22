<?php

namespace App\Http\Controllers\Api\Client\Auth;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function loginUrl()
    {
        return Response::json([
            'url' => Socialite::driver('google')->stateless()->redirect()->getTargetUrl(),
        ]);
    }

    public function loginCallback()
    {
        return Response::json(['googleUser' => 'googleUser']);
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = null;


        if ($googleUser) {
            $user = User::where('social_id',  strval($googleUser->getId()))
                ->where('social_provider', 'google')
                ->where('role_id', 2)
                ->get();

            if (count($user) == 0) {
                $data = [
                    'social_id' => $googleUser->getId(),
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'role_id' => 2,
                    'image' => $googleUser->getAvatar(),
                    'social_provider' => 'google',
                ];

                $user = User::create($data);

                $tookenAuth = createTooken($user[0]);
                return Response::json([
                    'user' => $user,
                    'token' => $tookenAuth,
                ]);
            }

            $tookenAuth = createTooken($user[0]);
            return Response::json([
                'user' => [
                    'name' => $user[0]['name'],
                    'email' => $user[0]['email'],
                    'image' => $user[0]['image'],
                    'adress' => $user[0]['adress'],
                ],
                'token' => $tookenAuth,
            ]);
        }

        return Response::json([
            'status' => 404,
            'messges' => 'Error login',
        ], 403);
    }
}
