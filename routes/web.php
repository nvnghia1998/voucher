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

 Route::get('/', function () {
    return view('welcome');
});
// Route::group(['prefix'=>'admin'],function () {
    //Route::get('dasboard', 'DasboardController@index');
    //Route::get('login', ['as'=>'admin_login','uses'=>'Admin\AdminLoginController@getLogin']);
    // Route::post('handleLogin', ['as'=>'admin_handle_login','uses'=>'Auth\LoginController@handleLogin']);
    // Route::get('register',['as'=>'admin_register','uses'=>'Auth\RegisterController@register']);
    // Route::post('create',['as'=>'admin_create','uses'=>'Auth\RegisterController@create']);
// });


Route::group(['middleware' => [checkAdminLogin::class], 'prefix' => 'admin', 'namespace' => 'Admin'], function() {
	Route::get('/', function() {
		return view('admin.dasboard');
	});
    Route::get('dasboard', function(){
        return view('admin.dasboard');
    });
    Route::get('logout', [App\Http\Controllers\Admin\AdminLoginController::class, 'getLogout'])->name('logout');

    // Route user
    Route::get('users',[App\Http\Controllers\Admin\UserController::class,'index'])->name('list_users');
    Route::get('users/create',[App\Http\Controllers\Admin\UserController::class,'getform']);
    Route::get('users/edit/{id}',[App\Http\Controllers\Admin\UserController::class,'edit'])->name('edit_users');
    Route::get('users/deleted/{id}',[App\Http\Controllers\Admin\UserController::class,'detroy'])->name('deleted_users');
    Route::post('users/create',[App\Http\Controllers\Admin\UserController::class,'create'])->name('create_users');

    // Route post
    // Route::group(['prefix => "posts'], function() {
    Route::get('posts',[App\Http\Controllers\Admin\PostController::class,'index'])->name('list_posts');
    Route::get('posts/create',[App\Http\Controllers\Admin\PostController::class,'getform'])->name('post_form');
    Route::get('posts/edit/{id}',[App\Http\Controllers\Admin\PostController::class,'edit'])->name('edit_post');
    Route::get('posts/deleted/{id}',[App\Http\Controllers\Admin\PostController::class,'detroy'])->name('deleted_post');
    Route::post('posts/create',[App\Http\Controllers\Admin\PostController::class,'create'])->name('create_post');
    //});
    
    Route::get('category',[App\Http\Controllers\Admin\CategoryController::class,'index'])->name('list_cate');
});
