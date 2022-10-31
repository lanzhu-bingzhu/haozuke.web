<?php

use App\Http\Controllers\EsController as AdminEsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\FangattrController;
use App\Http\Controllers\FangController;
use App\Http\Controllers\GatherController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\PowerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\UserCheck;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// QL抓取
Route::get('gather', [GatherController::class, 'index']);

// 登陆路由
Route::group(['prefix' => 'login/'], function () {
    // 登陆页面
    Route::get('/', [LoginController::class, 'index'])->name('login');
    // 执行登陆
    Route::post('sign', [LoginController::class, 'send'])->name('login/sign');
    // 获取验证码
    Route::get('getCode', [LoginController::class, 'getCode'])->name('login/getCode');
    // 退出登陆
    Route::get('quit', [LoginController::class, 'quit'])->name('quit');
});

// 权限不足视图
Route::view('error/power', 'errors.index', config('httpstatuscode.403'))->name('error/power');

// 需登陆访问
Route::group(['middleware' => UserCheck::class], function () {
    // 后台管理主页
    Route::get('index', [IndexController::class, 'index'])->name('admin/index');

    // 管理员路由
    Route::group(['prefix' => 'admin/'], function () {
        // 管理员添加功能
        Route::post('admin/save', [AdminController::class, 'adminSave'])->name('admin/create');
        // 编辑管理员信息
        Route::post('admin/update', [AdminController::class, 'adminUpdate'])->name('admin/update');
        // 修改管理员启用状态
        Route::get('adminStatic', [AdminController::class, 'adminStatic'])->name('admin/static');
        // 删除管理员
        Route::any('admin/delete', [AdminController::class, 'adminDelete'])->name('admin/delete');
        // 唯一性验证
        Route::get('admin/remote', [AdminController::class, 'remote'])->name('admin/remote');
    });

    // 角色路由
    Route::group(['prefix' => 'role/'], function () {
        // 角色添加功能
        Route::post('role/save', [RoleController::class, 'roleSave'])->name('role/create');
        // 角色删除功能
        Route::any('role/delete', [RoleController::class, 'roleDelete'])->name('role/delete');
        // 角色修改功能
        Route::post('role/update', [RoleController::class, 'roleUpdate'])->name('role/update');
        // 角色权限分配
        Route::post('role/powerUpdate', [RoleController::class, 'rolePowerSave'])->name('role/powerUpdate');
    });

    // 权限路由
    Route::group(['prefix' => 'power/'], function () {
        // 权限添加功能
        Route::post('power/save', [PowerController::class, 'powerSave'])->name('power/create');
        // 权限修改功能
        Route::post('power/update', [PowerController::class, 'powerUpdate'])->name('power/update');
        // 权限删除功能
        Route::any('power/delete', [PowerController::class, 'powerDelete'])->name('power/delete');
    });

    // 用户路由
    Route::group(['prefix' => 'user/'], function () {
        // 用户添加功能
        Route::post('user/save', [UserController::class, 'save'])->name('admin/user/create');
    });

    // 文章路由
    Route::group(['prefix' => 'article/'], function () {
        // 添加文章
        Route::post('article/save', [ArticleController::class, 'save'])->name('article/save');
        // 删除文章
        Route::any('article/delete', [ArticleController::class, 'delete'])->name('article/delete');
        // 修改文章
        Route::post('article/update', [ArticleController::class, 'update'])->name('article/update');
        // 富文本编辑器上传接口
        Route::post('article/imageUpload', [ArticleController::class, 'imageUpload'])->name('article/imageUpload');
    });

    // 房源属性路由
    Route::group(['prfix' => 'fangattr/'], function () {
        // 添加房源属性
        Route::post('fangattr/save', [FangattrController::class, 'save'])->name('fangattr/create');
        // 删除房源属性
        Route::any('fangattr/delete', [FangattrController::class, 'delete'])->name('fangattr/delete');
        // 修改房源属性
        Route::post('fangattr/update', [FangattrController::class, 'update'])->name('fangattr/update');
    });

    // 房源信息路由
    Route::group(['prfix' => 'fang/'], function () {
        // 添加房源信息
        Route::post('fang/save', [FangController::class, 'save'])->name('fang/create');
        // 删除房源信息
        Route::any('fang/delete', [FangController::class, 'delete'])->name('fang/delete');
        // 修改房源信息
        Route::post('fang/update', [FangController::class, 'update'])->name('fang/update');
        // 富文本编辑器上传接口
        Route::post('fang/imageUpload', [FangController::class, 'imageUpload'])->name('fang/imageUpload');
        // 修改房源状态
        Route::get('fang/status', [FangController::class, 'status'])->name('fang/status');
    });

    // 房东路由
    Route::group(['prfix' => 'owner'], function () {
        // 房东信息添加
        Route::post('owner/save', [OwnerController::class, 'save'])->name('owner/create');
        // 房东信息修改
        Route::post('owner/update', [OwnerController::class, 'update'])->name('owner/update');
        // 房东信息删除
        Route::any('owner/delete', [OwnerController::class, 'delete'])->name('owner/delete');
    });
    // 省市区三级联动
    Route::get('city', [FangController::class, 'city'])->name('fang/city');

    // 视图路由
    Route::group(['prefix' => 'view/'], function () {
        // 桌面页面
        Route::view('welcome', 'admin.welcome')->name('view/welcome');

        /**
         * 会员管理
         */
        // 用户列表
        Route::get('memberList', [UserController::class, 'index'])->name('view/member-list');
        // 用户添加表单
        Route::view('memberAdd', 'user.member-add')->name('view/member-add');

        /**
         * 管理员管理
         */
        // 角色管理列表
        Route::get('roleList', [RoleController::class, 'role'])->name('view/admin-role');
        // 添加角色
        Route::get('roleAdd', [RoleController::class, 'roleAdd'])->name('view/admin/role-add');
        // 角色修改视图
        Route::get('tolePowerUpdate', [RoleController::class, 'alterPower'])->name('view/admin/role-power-update');

        // 权限管理列表
        Route::get('powerList', [PowerController::class, 'power'])->name('view/admin-permission');
        // 权限添加视图
        Route::get('powerAdd', [PowerController::class, 'powerAdd'])->name('view/admin/power-add');

        // 管理员列表
        Route::get('adminList', [AdminController::class, 'admin'])->name('view/admin-list');
        // 添加管理员
        Route::get('adminAdd', [AdminController::class, 'adminAdd'])->name('view/admin-add');

        // 文章列表
        Route::get('articleList', [ArticleController::class, 'index'])->name('view/article-list');
        // 文章添加列表
        Route::get('articleAdd', [ArticleController::class, 'create'])->name('view/article-add');

        /**
         * 房源管理
         */
        // 房源规格列表
        Route::get('fangattrList', [FangattrController::class, 'index'])->name('view/fangattr-list');
        // 房源规格添加
        Route::get('fangattrAdd', [FangattrController::class, 'create'])->name('view/fangattr-add');

        // 房源信息列表
        Route::get('fangList', [FangController::class, 'index'])->name('view/fang-list');
        // 房源信息添加
        Route::get('fangAdd', [FangController::class, 'create'])->name('view/fang-add');
        // 可视化图表
        Route::get('fangChart', [FangController::class, 'chart'])->name('view/fang-chart');

        /**
         * 房东管理
         */
        // 房东列表
        Route::get('ownerList', [OwnerController::class, 'index'])->name('view/owner-list');
        // 房东添加
        Route::get('ownerAdd', [OwnerController::class, 'create'])->name('view/owner-add');
    });
});

Route::get('es', [AdminEsController::class, 'index']);