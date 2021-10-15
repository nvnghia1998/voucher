<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\checkAdminLogin;
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

Route::group(['prefix'=>'admin'],function () {
Route::get('login', [App\Http\Controllers\Admin\AdminLoginController::class, 'getLogin'])->name('login');
Route::post('login', [App\Http\Controllers\Admin\AdminLoginController::class, 'postLogin']);
Route::get('register',[App\Http\Controllers\Admin\AdminRegisterController::class,'getRegister'])->name('register');
Route::post('register',[App\Http\Controllers\Admin\AdminRegisterController::class,'postRegister']);
});

 // Front end route
Route::get('/posts', [App\Http\Controllers\HomeController::class,'index'])->name('home');
Route::post('/posts', [App\Http\Controllers\HomeController::class,'filterListVoucher'])->name('filter_list_post');
Route::get('/posts/{id}', [App\Http\Controllers\HomeController::class,'detail'])->name('detail_post');
Route::post('/posts/{id}', [App\Http\Controllers\HomeController::class,'create_voucher'])->name('create_voucher');

// Admin route
Route::group(['middleware' => [checkAdminLogin::class], 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
	Route::get('/', function() {
		return view('admin.dasboard');
	});
    Route::get('dasboard', function(){
        return view('admin.dasboard');
    });
    Route::get('logout', [App\Http\Controllers\Admin\AdminLoginController::class, 'getLogout'])->name('logout');

    
    Route::get('users',[App\Http\Controllers\Admin\UserController::class,'index'])->name('list_users');
    Route::get('users/create',[App\Http\Controllers\Admin\UserController::class,'getform'])->name('form_create_user');
    Route::get('users/edit/{id}',[App\Http\Controllers\Admin\UserController::class,'edit'])->name('edit_users');
    Route::get('users/deleted/{id}',[App\Http\Controllers\Admin\UserController::class,'destroy'])->name('deleted_users');
    Route::post('users/create',[App\Http\Controllers\Admin\UserController::class,'create'])->name('create_users');

    Route::get('posts',[App\Http\Controllers\Admin\PostController::class,'index'])->name('list_posts');
    Route::get('posts/create',[App\Http\Controllers\Admin\PostController::class,'getform'])->name('post_form');
    Route::get('posts/edit/{id}',[App\Http\Controllers\Admin\PostController::class,'edit'])->name('edit_post');
    Route::get('posts/deleted/{id}',[App\Http\Controllers\Admin\PostController::class,'destroy'])->name('deleted_post');
    Route::post('posts/create',[App\Http\Controllers\Admin\PostController::class,'create'])->name('create_post');
    
    Route::get('category',[App\Http\Controllers\Admin\CategoryController::class,'index'])->name('list_cate');
});
