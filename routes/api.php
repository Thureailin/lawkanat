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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post('Login', 'Api\LoginController@loginProcess');

Route::post('New_Login', 'Api\LoginController@new_loginProcess');

Route::post('facebookLogin', 'Api\LoginController@facebookLogin');

Route::post('Register', 'Api\LoginController@register');

Route::post('New_Register','Api\LoginController@new_register');

Route::group(['middleware' => ['auth:api','CustomerPermissionAPI']], function () {

	Route::post('updatePassword', 'Api\LoginController@updatePassword');

	Route::post('editProfile', 'Api\CustomerController@editProfile');

	Route::post('storeOrder', 'Api\CustomerController@storeOrder');

	Route::post('storeOrderWithDelivery', 'Api\CustomerController@storeOrderWithDelivery');

	Route::post('getOrderList', 'Api\CustomerController@getOrderList');

	Route::post('getOrderDetails', 'Api\CustomerController@getOrderDetails');

	Route::post('acceptOrder', 'Api\CustomerController@acceptOrder');

});

Route::group(['middleware' => ['auth:api','ShopPermissionAPI']], function () {



	Route::post('getShopOrderFinishedList', 'Api\EmployeeController@getShopOrderFinishedList');

	Route::post('getVoucherList', 'Api\EmployeeController@getVoucherList');




	//Kitchen

	Route::get('getKitchenOrderList', 'Api\EmployeeController@getKitchenOrderList');

	Route::post('changeCookingStatus', 'Api\EmployeeController@changeCookingStatus');

	Route::post('changeFinishedStatus', 'Api\EmployeeController@changeFinishedStatus');

	Route::post('changeOrderType','Api\EmployeeController@changeOrderType');

});

Route::group(['middleware' => ['auth:api']], function () {

    Route::post('getTableTypeList', 'Api\EmployeeController@getTableTypeList');

	Route::post('storeShopOrder', 'Api\EmployeeController@storeShopOrder');

	Route::post('getShopOrderPendingList', 'Api\EmployeeController@getShopOrderPendingList');

	Route::post('getShopOrderDetails', 'Api\EmployeeController@getShopOrderDetails');

	Route::post('addMoreItem', 'Api\EmployeeController@addMoreItem');

	Route::post('storeVoucher', 'Api\EmployeeController@storeVoucher');

    Route::post('getTableList', 'Api\EmployeeController@getTableList');

	Route::post('getMealList', 'Api\CustomerController@getMealList');

    Route::post('getCodeList', 'Api\CustomerController@getCodeList');

	Route::post('getTownshipList', 'Api\CustomerController@getTownshipList');

	Route::post('getCuisineTypeList', 'Api\CustomerController@getCuisineTypeList');

	Route::post('getMenuItemList', 'Api\CustomerController@getMenuItemList');

	Route::post('getOptionList', 'Api\CustomerController@getOptionList');

	Route::post('Logout', 'Api\LoginController@logoutProcess');


	Route::post('rating', 'Api\RatingController@rating');

	Route::post('rating/delivery', 'Api\RatingController@deliveryRating')->name('delivery_rating');

});

