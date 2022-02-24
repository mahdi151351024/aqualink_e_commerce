<?php
namespace App\Repositories;

use Illuminate\Support\Facades\Auth;

class AuthRepository implements AuthInterface
{

    public function loginUser(array $data)
    {
        $response = [];
        $login_data = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];
        if (!Auth::attempt($login_data)) {
            $response = [
                'status' => false,
                'message' => 'Invalid email or password',
            ];
        } else {
            $access_token = Auth::user()->createToken('auth_token')->accessToken;
            $response = [
                'status' => true,
                'data' => [
                    'user' => Auth::user(),
                    'access_token' => $access_token,
                ],
            ];
        }
        return $response;
    }
}
