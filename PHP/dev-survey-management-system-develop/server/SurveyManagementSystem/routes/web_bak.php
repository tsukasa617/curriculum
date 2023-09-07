<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/','SurveyController@index')->middleware('auth');

//顧客一覧 全権限
Route::group(['prefix' => 'client', 'middleware' => ['auth']], function() {
    Route::get('index','ClientController@index');
    Route::get('all','ClientController@all');
    Route::get('detail','ClientController@detail');
    Route::get('export','ClientController@export');
    Route::get('detail_export','ClientController@detail_export');

    Route::get('saletalk_history','ClientController@saletalk_history');
    Route::get('saletalk_detail','ClientController@saletalk_detail');
    Route::get('saletalk_export','ClientController@saletalk_export');
    Route::get('saletalk_detail_export','ClientController@saletalk_detail_export');

    Route::get('order_history','ClientController@order_history');
    Route::get('order_detail','ClientController@order_detail');
    Route::get('order_export','ClientController@order_export');
    Route::get('order_detail_export','ClientController@order_detail_export');

});
//顧客一覧 編集者権限以上
Route::group(['prefix' => 'client', 'middleware' => ['auth', 'can:edit']], function() {
    Route::get('create','ClientController@create');
    Route::post('create_check','ClientController@create_check');
    Route::get('create_check','ClientController@create_check');
    Route::post('create_add','ClientController@create_add');
    Route::get('create_add','ClientController@create_add');
    Route::get('edit','ClientController@edit');
    Route::post('edit_check','ClientController@edit_check');
    Route::get('edit_check','ClientController@edit_check');
    Route::post('update','ClientController@update');
    Route::get('update','ClientController@update');
    Route::get('delete','ClientController@delete');

    Route::get('saletalk_edit','ClientController@saletalk_edit');
    Route::get('saletalk_delete','ClientController@saletalk_delete');
    Route::post('saletalk_update','ClientController@saletalk_update');
    Route::get('saletalk_update','ClientController@saletalk_update');
    
    Route::get('order_edit','ClientController@order_edit');
    Route::get('order_delete','ClientController@order_delete');
    Route::post('order_update','ClientController@order_update');
    Route::get('order_update','ClientController@order_update');

    Route::post('order_history_update','ClientController@order_history_update');
    Route::get('order_history_update','ClientController@order_history_update');
    Route::post('order_history_delete','ClientController@order_history_delete');
    Route::get('order_history_delete','ClientController@order_history_delete');
    Route::post('order_history_add','ClientController@order_history_add');
    Route::get('order_history_add','ClientController@order_history_add');
});
//マスター管理 全権限
Route::group(['prefix' => 'master', 'middleware' => ['auth']], function() {
    Route::get('index','MasterController@index');
});
//従業員一覧 全権限
Route::group(['prefix' => 'user', 'middleware' => ['auth']], function() {
    Route::get('all','UserController@all');
    Route::get('detail','UserController@detail');
    Route::get('export','UserController@export');
    Route::get('detail_export','UserController@detail_export');
});
//従業員一覧 管理者権限のみ
Route::group(['prefix' => 'user', 'middleware' => ['auth', 'can:admin']], function() {
    Route::get('create','UserController@create');
    Route::post('create_check','UserController@create_check');
    Route::get('create_check','UserController@create_check');
    Route::post('create_add','UserController@create_add');
    Route::get('create_add','UserController@create_add');
    Route::get('edit','UserController@edit');
    Route::post('edit_check','UserController@edit_check');
    Route::get('edit_check','UserController@edit_check');
    Route::post('update','UserController@update');
    Route::get('update','UserController@update');
    Route::get('delete','UserController@delete');
    Route::get('pass_set', 'UserController@pass_set');
    Route::post('pass_reset', 'UserController@pass_reset');
});
//お客様対応 全権限
Route::group(['prefix' => 'customersupport', 'middleware' => ['auth']], function() {
    Route::get('index','CustomerSupportController@index');
});
//クレーム 全権限
Route::group(['prefix' => 'complaint', 'middleware' => ['auth']], function() {
    Route::get('all','ComplaintController@all');
    Route::get('detail','ComplaintController@detail');
    Route::get('export','ComplaintController@export');
    Route::get('detail_export','ComplaintController@detail_export');
});
//クレーム 編集者権限以上
Route::group(['prefix' => 'complaint', 'middleware' => ['auth', 'can:edit']], function() {
    Route::get('create','ComplaintController@create');
    Route::post('create_check','ComplaintController@create_check');
    Route::get('create_check','ComplaintController@create_check');
    Route::post('create_add','ComplaintController@create_add');
    Route::get('create_add','ComplaintController@create_add');
    Route::get('edit','ComplaintController@edit');
    Route::post('update','ComplaintController@update');
    Route::get('update','ComplaintController@update');
    Route::get('delete','ComplaintController@delete');
});
//お問い合わせ 全権限
Route::group(['prefix' => 'inquiry', 'middleware' => ['auth']], function() {
    Route::get('all','InquiryController@all');
    Route::get('detail','InquiryController@detail');
    Route::get('export','InquiryController@export');
    Route::get('detail_export','InquiryController@detail_export');
});
//お問い合わせ 編集者権限以上
Route::group(['prefix' => 'inquiry', 'middleware' => ['auth', 'can:edit']], function() {
    Route::get('create','InquiryController@create');
    Route::post('create_check','InquiryController@create_check');
    Route::get('create_check','InquiryController@create_check');
    Route::post('create_add','InquiryController@create_add');
    Route::get('create_add','InquiryController@create_add');
    Route::get('edit','InquiryController@edit');
    Route::post('update','InquiryController@update');
    Route::get('update','InquiryController@update');
    Route::get('delete','InquiryController@delete');
});
//商談履歴登録 編集者権限以上
Route::group(['prefix' => 'saletalk', 'middleware' => ['auth', 'can:edit']], function() {
    Route::get('create','SaletalkController@create');
    Route::post('create_check','SaletalkController@create_check');
    Route::get('create_check','SaletalkController@create_check');
    Route::post('create_add','SaletalkController@create_add');
    Route::get('create_add','SaletalkController@create_add');
});
//注文履歴登録 編集者権限以上
Route::group(['prefix' => 'order', 'middleware' => ['auth', 'can:edit']], function() {
    Route::get('create','OrderController@create');
    Route::post('create_check','OrderController@create_check');
    Route::get('create_check','OrderController@create_check');
    Route::post('create_add','OrderController@create_add');
    Route::get('create_add','OrderController@create_add');
});
//グラフ 全権限
Route::group(['prefix' => 'search', 'middleware' => ['auth']], function() {
    Route::get('/index','SearchController@index');
    Route::post('/index','SearchController@result');
    Route::get('export','SearchController@search_saletalk_export');
});
//検索 全権限
Route::group(['prefix' => 'graph', 'middleware' => ['auth']], function() {
    Route::get('/','GraphController@index');
    Route::get('/getGraph','GraphController@getGraph');
    Route::get('/getBar/{min_date}/max_date/{max_date}','GraphController@getBar');
});