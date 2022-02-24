<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AuthInterface;
use Exception;

class LoginController extends Controller
{
    protected $user_auth;

    public function __construct(AuthInterface $user_auth)
    {
        $this->user_auth = $user_auth;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5'
        ]);
        $response = [];
        try{
            $response = $this->user_auth->loginUser($request->all());
        }
        catch(Exception $e)
        {
            $response = [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }
        return response()->json($response);
    }
}
