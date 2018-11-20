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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group([
		'prefix' => 'v1',
    'middleware' => 'api' 
], function () {
		
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');

    Route::get('kategori','tbKategoriController@index');

    // Route::resource('jasa','TbDataJasaController');
    Route::get('showDataJasa/{id}','TbDataJasaController@show');

    Route::post('store_data_jasa','TbDataJasaController@store');

    Route::post('sendNotification','NotificationController@sendNotification');

    Route::post('storeKategori','TbKategoriController@store');
});

