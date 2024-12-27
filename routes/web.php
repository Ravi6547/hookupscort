<?php

use Illuminate\Support\Facades\Auth;
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
    $cites = [1 => 'Mohali', 2 => 'Chandigarh', 3 => 'Kharar'];
    return view('welcome', compact('cites'));

});
Route::get('/getList', [App\Http\Controllers\UsersController::class, 'index'])->name('getList');
Route::get('/searchUser', [App\Http\Controllers\UsersController::class, 'searchUser'])->name('searchUser');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => 'admin.guest'],function(){
        Route::view('login','admin.login')->name('admin.login');
        Route::post('login',[App\Http\Controllers\AdminController::class,'login'])->name('admin.auth');
    });
    Route::group(['middleware' => 'admin.auth'],function(){
        // Route::view('dashboard','admin.home')->name('admin.home');
        Route::get('/', 'App\Http\Controllers\Admin\AdminController@index')->name('admin.home');
        Route::get('dashboard', 'App\Http\Controllers\Admin\AdminController@index')->name('admin.home');
        Route::resource('/roles', 'App\Http\Controllers\Admin\RolesController');
        Route::resource('/permissions', 'App\Http\Controllers\Admin\PermissionsController');
        Route::resource('/users', 'App\Http\Controllers\Admin\UsersController');
        Route::resource('/pages', 'App\Http\Controllers\Admin\PagesController');
        Route::resource('/activitylogs', 'App\Http\Controllers\Admin\ActivityLogsController')->only([
            'index', 'show', 'destroy'
        ]);
        Route::resource('/settings', 'App\Http\Controllers\Admin\SettingsController');
        Route::get('/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
        Route::post('/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);
        Route::post('logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout');
    });
});

