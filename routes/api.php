<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['prefix' => 'sales-person'], function () {	
	Route::post('/login','Api\UserController@login');	
	Route::get('/dashboard/{id}','Api\UserController@dashboard');
		// Route::get('/logout', function () {
		//     Session::forget('salesPerson');
		//     	return redirect('/sales-person');
		// });
		// Route::Resource('customer','CustomerController');
		Route::get('customer/{id}','Api\CustomerController@index');
		Route::post('customer/store','Api\CustomerController@store');
		Route::get('customer/edit/{id}','Api\CustomerController@edit');
		Route::post('customer/update','Api\CustomerController@update');
		Route::get('customer/delete/{id}','Api\CustomerController@destroy');
		Route::get('sale/{uid}','Api\SaleController@index');
		Route::get('sale-create/{id}','Api\SaleController@sell');
		Route::post('sale-store','Api\SaleController@sellCustomer');
});


