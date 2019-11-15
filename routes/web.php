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

Route::get('/', function(){
    return view('welcome');
});

Auth::routes();

/*
|------------------------------------------------------------------
| Route groups backend route
|------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard', 'Backend\DashboardController@index')->name('dashboard');
    Route::get('admin', 'Backend\AdminController@index')->name('admin');
    Route::get('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');
    Route::namespace('Backend')->prefix('admin')->name('admin.')->group(function(){
        /*
        |------------------------------------------------------------------
        | Only super admin group
        |------------------------------------------------------------------
        */
        Route::group(['middleware' => ['role:super_admin']], function(){
            Route::get('superadmin/json','SuperAdminController@json'); // datatable
            Route::resource('super-admin', 'SuperAdminController')->only(['edit', 'update', 'index', 'show', 'create', 'store']);

            // --------------------------------------------------------------
            // Route::resource('histories', 'LoginHistoryController');
            // --------------------------------------------------------------
        });
        Route::group(['middleware' => ['role:super_admin, admin']], function(){
            Route::get('admins/json','AdminController@json'); // datatable
            Route::resource('admins', 'AdminController');
        });
    });
});
