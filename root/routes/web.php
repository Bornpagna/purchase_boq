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

Auth::routes();

Route::get('', 'HomeController@index');
Route::get('prefix/gen/{type}/{objModel}/{columnName}', 'PrefixController@autoPrefix');
Route::post('sidebar', 'LanguageController@setSidebar');
Route::post('theme', 'LanguageController@setTheme');
Route::get('alert/notification', 'LanguageController@getNotification');

Route::get('user/permis/{id}/{type}', 'UserController@permission')->middleware('checkRole:user_permission');
Route::get('group/permis/{id}/{type}', 'UserController@permission')->middleware('checkRole:group_permission');
Route::post('user/permis/save/{id}/{type}', 'UserController@savePermission')->middleware('checkRole:user_permission');
Route::post('group/permis/save/{id}/{type}', 'UserController@savePermission')->middleware('checkRole:group_permission');

/////////////////////////rounte project //////////////////////////////////permis
Route::group(['prefix'=>'project'], function(){
	Route::get('','ProjectController@index');
	Route::post('save','ProjectController@save');
	Route::post('edit/{id}','ProjectController@update');
	Route::get('delete/{id}','ProjectController@destroy');
	Route::get('excel/download','ProjectController@downloadExcel');
	Route::get('choose/{id}', 'ProjectController@choose');
	// Import & Export BOQ
	Route::get('downloadSampleExcelBOQ','ProjectController@downloadSampleExcelBOQ');
	Route::post('importSampleExcelBOQ','ProjectController@importSampleExcelBOQ');
});

////////////////////// route language //////////////////
Route::post('language-chooser','LanguageController@changeLanguage');
Route::post('language/', array(
    'before' => 'csrf',
    'as' => 'language-chooser',
    'uses' => 'LanguageController@changeLanguage'
));

/////////////////////////////rounte users////////////////////////////
Route::group(['prefix'=>'user'],function(){
	Route::get('','UserController@index')->middleware('checkRole:user');
	Route::get('dt','UserController@getDt');
	Route::post('save','UserController@store')->middleware('checkRole:user_add');
	Route::post('reset/{id}','UserController@resetPass')->middleware('checkRole:user_reset');
	Route::post('edit/{id}','UserController@update')->middleware('checkRole:user_edit');
	Route::get('destroy/{id}','UserController@destroy')->middleware('checkRole:user_delete');
	Route::get('profile','UserController@profile');
	Route::get('profile/pass','UserController@viewChangePassword');
	Route::post('profile/update/info','UserController@changeInfo');
	Route::post('profile/update/image','UserController@changeImage');
	Route::post('profile/update/password','UserController@changePassword');
	Route::get('bcrypt/{password}','UserController@bcrypt');
	Route::get('task','UserController@myTask')->middleware('checkRole:approve');
	Route::get('prDt','UserController@getPRDt');
	Route::get('poDt','UserController@getPODt');
});

/////////////////////////rounte setting //////////////////////////////////
Route::group(['prefix'=>'setting'],function(){
	Route::get('','SettingController@index')->middleware('checkRole:setting');
	Route::post('save','SettingController@save')->middleware('checkRole:setting');
});

/////////////////////////rounte activity //////////////////////////////////
Route::group(['prefix'=>'activity'],function(){
	Route::get('','UserActivityController@index')->middleware('checkRole:user_log');
	Route::get('dt','UserActivityController@show');
});

//////////////////////////Backup//////////////////////////////////////////
Route::group(['prefix'=>'backup'],function(){
	Route::get('','BackupController@index')->middleware('checkRole:backup');
	Route::get('dt','BackupController@dt');
	Route::post('save','BackupController@save')->middleware('checkRole:backup_add');
	Route::get('download/{id}','BackupController@download')->middleware('checkRole:backup_download');
	Route::get('destroy/{id}','BackupController@destroy')->middleware('checkRole:backup_delete');	
});

///////////////////// route role ///////////////////////////
Route::group(['prefix' => 'role'], function() {
	Route::get('','RoleController@index')->middleware('checkRole:role');
	Route::get('dt','RoleController@getDt');
	Route::get('subdt/{id}','RoleController@subDt');
	Route::post('save','RoleController@save')->middleware('checkRole:role_add');
	Route::post('edit/{id}','RoleController@update')->middleware('checkRole:role_edit');
	Route::post('assign/{id}','RoleController@assign')->middleware('checkRole:role_assign');
	Route::get('delete/{id}','RoleController@destroy')->middleware('checkRole:role_delete');
});

//////////////////////////trash////////////////////////////////////////////
Route::group(['prefix'=>'trash'],function(){
	Route::group(['prefix'=>'entry'],function(){
		Route::get('','TrashController@fnEntry')->middleware('checkRole:trash_stock_entry');
		Route::get('dt','TrashController@entryDt');
		Route::get('subdt/{id}','TrashController@entrySubDt');
	});
	
	Route::group(['prefix'=>'import'],function(){
		Route::get('','TrashController@fnImport')->middleware('checkRole:trash_stock_import');
		Route::get('dt','TrashController@importDt');
		Route::get('subdt/{id}','TrashController@importSubDt');
	});
	
	Route::group(['prefix'=>'adjust'],function(){
		Route::get('','TrashController@fnAdjust')->middleware('checkRole:trash_stock_adjust');
		Route::get('dt','TrashController@adjustDt');
		Route::get('subdt/{id}','TrashController@adjustSubDt');
	});
	
	Route::group(['prefix'=>'move'],function(){
		Route::get('','TrashController@fnMove')->middleware('checkRole:trash_stock_move');
		Route::get('dt','TrashController@moveDt');
		Route::get('subdt/{id}','TrashController@moveSubDt');
	});
	
	Route::group(['prefix'=>'delivery'],function(){
		Route::get('','TrashController@fnDelivery')->middleware('checkRole:trash_stock_delivery');
		Route::get('dt','TrashController@deliveryDt');
		Route::get('subdt/{id}','TrashController@deliverySubDt');
	});
	
	Route::group(['prefix'=>'redelivery'],function(){
		Route::get('','TrashController@fnReturnDelivery')->middleware('checkRole:trash_stock_return_delivery');
		Route::get('dt','TrashController@redeliveryDt');
		Route::get('subdt/{id}','TrashController@redeliverySubDt');
	});
	
	Route::group(['prefix'=>'usage'],function(){
		Route::get('','TrashController@fnUsage')->middleware('checkRole:trash_stock_usage');
		Route::get('dt','TrashController@usageDt');
		Route::get('subdt/{id}','TrashController@usageSubDt');
	});
	
	Route::group(['prefix'=>'reusage'],function(){
		Route::get('','TrashController@fnReturnUsage')->middleware('checkRole:trash_stock_return_usage');
		Route::get('dt','TrashController@reusageDt');
		Route::get('subdt/{id}','TrashController@reusageSubDt');
	});

	Route::group(['prefix'=>'request'],function(){
		Route::get('','TrashController@fnRequest')->middleware('checkRole:trash_request');
		Route::get('dt','TrashController@requestDt');
		Route::get('subdt/{id}','TrashController@requestSubDt');
	});

	Route::group(['prefix'=>'order'],function(){
		Route::get('','TrashController@fnOrder')->middleware('checkRole:trash_order');
		Route::get('dt','TrashController@orderDt');
		Route::get('subdt/{id}','TrashController@orderSubDt');
	});
});