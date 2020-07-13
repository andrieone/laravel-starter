<?php

use Illuminate\Http\Request;

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

use Illuminate\Support\Facades\Route;

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('v1')->group(function () {

    /* COMPANY */
    Route::get('companies', 'API\ApiCompanyController@all');
    Route::get('company/{id}', 'API\ApiCompanyController@single');

    /* PLACE */
    Route::get('places', 'API\ApiPlaceController@all');
    Route::get('place/{id}', 'API\ApiPlaceController@single');

    /* USER */
    Route::get('users', 'API\ApiUserController@all');
    Route::get('user/{id}', 'API\ApiUserController@single');
    Route::get('company_users/{id}', 'API\ApiUserController@companyUsers');

    /*POSTCODE*/
    Route::get('postcode/{postcode}', 'API\ApiPostcodeController@address');
});