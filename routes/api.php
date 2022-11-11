<?php

use App\Http\Controllers\Api\FangController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\NoticeController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', [LoginController::class, 'login'])->name('api/login');

Route::group(['middleware' => 'auth:api', 'namespace' => 'Api'], function () {
    // 登陆
    Route::get('wxlogin', [LoginController::class, 'wxlogin']);

    // 获取房源列表
    Route::get('fangs', [FangController::class, 'index']);

    // 添加用户信息
    Route::post('user/userinfo', [UserController::class, 'setUserInfo']);
    Route::get('user/userinfo', [UserController::class, 'getUserInfo']);

    // 文件上传
    Route::post('file/upload', [UserController::class, 'fileUpload']);
    // 认证
    Route::post('user/card', [UserController::class, 'cardUpload']);

    // 获取看房通知
    Route::get('notices', [NoticeController::class, 'index']);

    // 获取租房小组
    Route::get('fang/attr', [FangController::class, 'attr']);
    // 获取首页推荐房源
    Route::get('fangs/recommend', [FangController::class, 'recommend']);

    // 新闻列表
    Route::get('news/index', [NewsController::class, 'index']);
    // 新闻详情列表
    Route::get('news/details', [NewsController::class, 'details']);
});
