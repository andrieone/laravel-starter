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

// Auth::routes();
// Registration Routes...
// Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
// Route::post('register', 'Auth\RegisterController@register');

*/

Route::get('/', function(){
    return view('welcome');
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

/*
|------------------------------------------------------------------
| Route groups backend
|------------------------------------------------------------------
*/
Route::group(['middleware' => 'auth'], function(){
    Route::get('dashboard', function(){ return "TODO: Create simple dashboard contained count and simple chart"; })->name('dashboard');
    Route::get('setlanguage/{language}', 'Backend\LanguageController@SetLanguage')->name('setlanguage');
    Route::get('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');
    Route::namespace('Backend')->prefix('admin')->name('admin.')->group(function(){
        //------------------------------------------------------------------
        // Only super admin group
        //------------------------------------------------------------------
        Route::group(['middleware' => ['role:super_admin']], function(){
            Route::resource('superadmin', 'SuperAdminController');

            Route::resource('company', 'CompanyController');
            Route::resource('company.user', 'UserController');

            Route::resource('logactivities', 'LogActivityController')->only(['index', 'show']);
        });
        //------------------------------------------------------------------
        // Sharing for super admin and admin
        //------------------------------------------------------------------
        Route::group(['middleware' => ['role:super_admin,admin']], function(){
            Route::resource('admins', 'AdminController');
            Route::resource('news', 'NewsController');
        });
    });
});
