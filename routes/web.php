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

Route::group(['middleware' => 'auth.very_basic'], function() { // start basic auth protection

Route::get('/', function(){
    return view('welcome');
})->middleware('guest');

Route::get('/auth-check', function(){
    dd(Auth::guard("web")->check());
    //dd(Auth::guard("user")->user()->toArray());
});

// Authentication Routes...
Route::get('/admin/login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('/admin/login', 'Auth\LoginController@login');

Route::get('/login', 'Auth\CompanyUserLoginController@showLoginForm')->name('company-user-login');
Route::post('/login', 'Auth\CompanyUserLoginController@login')->name('company-user-login-action');;

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

Route::get('setlanguage/{language}', 'Backend\LanguageController@SetLanguage')->name('setlanguage');
Route::group(['middleware' => 'auth:web'], function(){
    Route::get('dashboard', function(){ return "@TODO: Create simple dashboard contained count and simple chart"; })->name('dashboard');
    Route::get('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');
    Route::namespace('Backend')->prefix('admin')->name('admin.')->group(function(){
        //------------------------------------------------------------------
        // Only super admin group
        //------------------------------------------------------------------
        Route::group(['middleware' => ['role:super_admin']], function(){
            Route::resource('superadmin', 'SuperAdminController');

            Route::resource('logactivities', 'LogActivityController')->only(['index', 'show']);
            Route::resource('company', 'CompanyController');
        });
        //------------------------------------------------------------------
        // Sharing for super admin and company admin
        //------------------------------------------------------------------
        Route::group(['middleware' => ['role:super_admin,company_admin']], function(){
            Route::resource('company', 'CompanyController')->only(['index', 'update', 'show', 'edit']);
            Route::resource('company.user', 'UserController');

            Route::resource('user', 'UserMasterController');
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

Route::group(['middleware' => 'auth:user'], function() {

    Route::get('logout', 'Auth\CompanyUserLoginController@logout')->name('logout');
    Route::group(['middleware' => ['user_role:supervisor,operator']], function () {

        Route::get('user', 'Backend\UserController@editAsUserOwner')->name('userowner-edit');
        Route::post('user', 'Backend\UserController@updateAsUserOwner')->name('userowner-update');

    });
});

});