<?php

use App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth', [Auth::class, 'auth']);
Route::get('/auth/verify', [Auth::class, 'verify']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});
