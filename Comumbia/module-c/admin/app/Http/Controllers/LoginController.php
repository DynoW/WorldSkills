<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login() {
        $request = request();
        $request->validate([
            'username' => 'required|username',
            'password' => 'required|min:6',
        ]);
        $username = filter_var($request->input('username'), FILTER_SANITIZE_STRING);
        $password = filter_var($request->input('password'), FILTER_SANITIZE_STRING);
        $credentials = ['username' => $username, 'password' => $password];
        if (auth()->attempt($credentials)) {
            $token = Str::random(60);
            $user = auth()->user();
            $user->token = hash('sha256', $token);
            $user->save();
            return response()->json(['message' => 'Successful authentication.'], 200);
        } else {
            return abort(401);
        }
    }

    public function logout() {
        $user = auth()->user();
        $user->api_token = null;
        $user->save();
        auth()->logout();
        return response()->json(['message' => 'Successful logout.'], 200);
    }
}
