<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function index()
    {
        $user = Users::where('email', request('email'))->first();

        if (!$user || ! Hash::check(request('password'), $user->password)) {
            return response([
                'message' => ['The provided credentials are incorrect.'. request('email')]
            ], 500);
        }

        $userToken = $user->createToken('api-token')->plainTextToken;
    
        return response(['token' => $userToken], 200);
    }
}
