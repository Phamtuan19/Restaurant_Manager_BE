<?php

use Illuminate\Support\Carbon;

function createTooken($user)
{
    if ($user) {

        $tokenResult = $user->createToken('token_auth');

        // Thiết lập Expires
        $token = $tokenResult->token;
        $token->expires_at = Carbon::now()->addMinutes(1);
        $token->save();
        // Trả về token
        $accessToken = $tokenResult->accessToken;


        // $expires = Carbon::parse($token->expires_at)->toDateTimeString();

        // return [
        //     'accessToken' => $accessToken,
        //     'expires' => $expires
        // ];
        return $accessToken;
    }
    return null;
}
