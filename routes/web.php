<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;


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




// ##################### Sales Person Routes ####################
Route::get('sales-person','UserController@index');
Route::group(['prefix' => 'sales-person'], function () {
    Route::post('/login','UserController@login');	
	Route::group(["middleware"=>['user_auth']],function(){
		Route::get('/dashboard','UserController@dashboard');
		Route::get('/logout', function () {
		    Session::forget('salesPerson');
		    	return redirect('/sales-person');
		});
		Route::Resource('customer','CustomerController');
		Route::get('sale','SaleController@index');
		Route::get('sale-create','SaleController@sell');
		Route::post('sale-store','SaleController@sellCustomer');
	});
});



// ##################### Admin Routes ####################

Route::get('admin','Admin\AdminController@index');
Route::group(['prefix' => 'admin'], function () {  
    Route::post('/login','Admin\AdminController@login');
	Route::group(["middleware"=>['admin_auth']],function(){
		Route::get('dashboard','Admin\AdminController@dashboard');
		Route::get('logout', function () {
	    Session::forget('admin');
	    	return redirect('admin');
		});
		Route::Resource('product','Admin\ProductController');	
		Route::Resource('sales-person','Admin\SalesPersonController');	
		Route::Resource('allotment','Admin\AllotmentController');	
		Route::get("allotment-previous-record/{id}",'Admin\AllotmentController@previousRecords');
		Route::get('product-return','Admin\ProductReturn@index');
		Route::get('sales-person-return-product/{id}','Admin\ProductReturn@todaysReturn');
		Route::get('sales-person-return-all-product/{id}','Admin\ProductReturn@allReturn');
	});
});
// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
