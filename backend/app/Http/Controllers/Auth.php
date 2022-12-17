<?php

namespace App\Http\Controllers;

use App\Custom\Jwt;
use App\Models\User;
use Illuminate\Http\Request;

class Auth extends Controller
{
  public function auth(Request $request)
  {
    $user = User::where('email', $request->email)->first();

    if (!$user) {
      return response()->json('not authorized', 401);
    }

    if (!password_verify($request->password, $user->password)) {
      return response()->json('not authorized', 401);
    }

    $token = Jwt::create($user);

    return response()->json([
      'token' => $token,
      'user' => [
        'firstName' => $user->firstName,
        'lastName' => $user->lastName
      ]
    ]);
  }

  public function verify()
  {
    return Jwt::validate();
  }
}
