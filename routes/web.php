<?php

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
    return view('welcome', ['sitename' => '世界多么美好~']);exit;
    return view('welcome');
});

Route::get('/test', function () {
	return '<form method="POST" action="http://localhost/jcjr_dwh/public/test1">' . csrf_field() . '<button type="submit">提交</button></form>';
});

Route::get('/test1/{id}', function ($id) {
    echo 1111 . $id;
});

Route::get('/test3', function() {
    echo 4444;
});

Route::get('/users', 'UserController@index');

Route::get('user/profile', function () {
    // 通过路由名称生成 URL
    return 'my url: ' . route('profile');
})->name('profile');

Route::get('redirect', function() {
    // 通过路由名称进行重定向
    return redirect()->route('profile');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
