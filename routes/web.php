<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\UrlController;
use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome');
Route::post('/register', [RegisterController::class,'register']);
Route::post('/login', [LoginController::class,'login']);
Route::post('/logout', [LoginController::class,'logout']);
Route::post('/password/email', [ForgotPasswordController::class,'sendResetLinkEmail']);
Route::post('/password/reset', [ResetPasswordController::class,'reset']);

Route::apiResource('/url', UrlController::class);

Route::get('u/{url}', [UrlController::class,'show']);
Route::any('{url}', function () {
    return view('welcome');
})->where('url', '.*');

Route::post('password/reset/{token}', function () {
    return '';
})->name('password.reset');
