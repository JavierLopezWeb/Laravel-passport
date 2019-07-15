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
Route::get('test', function(){
    return 'hello';

});
Route::post('test-post', function(){
    return 'hello';

});
//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

/*Route::group(['prefix' => 'auth'], function () {
    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('logout', 'AuthController@logout');
        Route::get('user', 'AuthController@user');
    });

});*/
Route::post('login', 'API\AccessController@login');

Route::post('register', 'API\AccessController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\AccessController@details');
});



Route::middleware('auth:api')->group( function () {
    Route::resource('products', 'API\ProductController');
});
Route::middleware('auth:api')->group( function () {
    Route::resource('films', 'API\FilmController');
});
Route::middleware('auth:api')->group( function () {
    Route::resource('filmlists', 'API\FilmListsController');
});
