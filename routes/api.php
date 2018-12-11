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
		
    Route::post('/login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('register', 'AuthController@register');

    Route::get('kategori','tbKategoriController@index');

    // Route::resource('jasa','TbDataJasaController');
    Route::get('showDataJasa/{id}','TbDataJasaController@show');
    Route::get('showDataJasaUser/{id}','TbDataJasaController@showDataJasaUser');
    Route::get('showDataJasaForAdmin/{id}','TbDataJasaController@showDataJasaforAdmin');

    Route::post('store_data_jasa','TbDataJasaController@store');

    Route::post('sendNotification','NotificationController@sendNotification');

    Route::post('storeKategori','TbKategoriController@store');

    Route::post('storeFavorite','TbFavoriteController@store');

    Route::get('showFavorite/{id}','TbFavoriteController@show');

    Route::delete('delete_kategori/{id}','TbKategoriController@destroy');

    Route::post('update_kategori/{id}','TbKategoriController@update');  

    Route::get('user', 'AuthController@getAuthenticatedUser');

    Route::post('checkFavorite','TbFavoriteController@checkFavorite');
    
    Route::post('updateFotoProfille', 'AuthController@updateFotoProfille'); 

    Route::post('update_profille/{id}','AuthController@updateProfille');    

    Route::get('delete_data_jasa/{id}','TbDataJasaController@edit'); 

    Route::delete('delete_favorite/{id}','TbFavoriteController@destroy'); 

    Route::get('update_status/{id}','TbDataJasaController@update');

    
});

