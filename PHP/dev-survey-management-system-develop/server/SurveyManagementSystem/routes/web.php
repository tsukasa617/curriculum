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

Route::get('front',function(){
    return view('front');
});

Route::get('error',function(){
    return view('errors/error_message');
});

/* LP */

Route::group(['prefix' => 'lp'], function() {
    Route::get('all','LpController@all');
    Route::post('all','LpController@all');
    Route::get('create','LpController@create');
    Route::post('create','LpController@create');
    Route::get('create_check','LpController@create_check');
    Route::post('create_check','LpController@create_check');
    Route::get('add','LpController@add');
    Route::post('add','LpController@add');
    Route::view('complete', 'Lp.lp_complete');
});

/* 案件管理ページ */

Route::group(['prefix' => 'matter', 'middleware' => ['auth']], function() {
    Route::get('all','MatterController@all');
    Route::post('all','MatterController@all');
    Route::get('detail','MatterController@detail');
    Route::post('detail','MatterController@detail');
    Route::get('create','MatterController@create');
    Route::post('create','MatterController@create');
    Route::get('create_check','MatterController@create_check');
    Route::post('create_check','MatterController@create_check');
    Route::get('create_add','MatterController@create_add');
    Route::post('create_add','MatterController@create_add');
    Route::post('create_search','MatterController@create_search');
    //ステータス
    Route::post('status_all','MatterController@matter_status_all');
    Route::get('status_all','MatterController@matter_status_all');
    Route::get('status_add','MatterController@matter_status_add');
    Route::post('status_add','MatterController@matter_status_add');
    Route::get('status_update','MatterController@matter_status_update');
    Route::post('status_update','MatterController@matter_status_update');
    Route::get('status_delete','MatterController@matter_status_delete');
    Route::post('status_delete','MatterController@matter_status_delete');
    Route::post('stn_change','MatterController@stn_change');
    Route::get('stn_change','MatterController@stn_change');
    Route::post('aps_change','MatterController@aps_change');
    Route::get('aps_change','MatterController@aps_change');
    //流入経路
    Route::post('advertising_all','MatterController@matter_advertising_all');
    Route::get('advertising_all','MatterController@matter_advertising_all');
    Route::get('advertising_add','MatterController@matter_advertising_add');
    Route::post('advertising_add','MatterController@matter_advertising_add');
    Route::get('advertising_update','MatterController@matter_advertising_update');
    Route::post('advertising_update','MatterController@matter_advertising_update');
    Route::get('advertising_delete','MatterController@matter_advertising_delete');
    Route::post('advertising_delete','MatterController@matter_advertising_delete');

    Route::post('img_add','MatterController@img_add');
    Route::get('img_add','MatterController@img_add');
    Route::get('img_del','MatterController@img_del');
    Route::get('img_download','MatterController@img_download');

    Route::get('delete','MatterController@delete');
    Route::get('edit','MatterController@edit');
    Route::post('edit','MatterController@edit');
    Route::post('edit_check','MatterController@edit_check');
    Route::get('edit_check','MatterController@edit_check');
    Route::post('update','MatterController@update');
    Route::get('update','MatterController@update');

    //キーワード検索
    Route::post('filter_search','MatterController@filter_search');
    Route::get('filter_search','MatterController@filter_search');

    //チェックボックス削除
    Route::post('check_delete/{value}','MatterController@check_delete');

    //プルダウン編集
    Route::post('check_edit/{value}/status_name/{status_name}/important_value/{important_value}','MatterController@check_edit');

    //Route::post('status_search','MatterController@status_search');
    //Route::get('status_search','MatterController@status_search');

    //HTML to Excelテスト
    Route::get('invoiceDownload','MatterController@invoiceDownload');
    Route::post('invoiceDownload','MatterController@invoiceDownload');
    
    // Route::get('matter_invoice_export','InvoiceExportTestController@create');
    // Route::post('matter_invoice_export','InvoiceExportTestController@create');
    // Route::post('matter_invoice_export','InvoiceExportTestController@invoice_output')->name('matter.invoiceExeport');
    // Route::get('matter_invoice_export','InvoiceExportTestController@invoice_output')->name('matter.invoiceExeport');
    
    //csvインポート
    Route::get('csv_import','MatterController@csv_import_view');
    Route::post('csv_import_check','MatterController@csv_import_check');
    Route::get('csv_import_check','MatterController@csv_import_check');
    Route::post('csv_import_add', 'MatterController@csv_import_add');//大村追記
    Route::get('csv_import_add', 'MatterController@csv_import_add');

    //CSVエクスポート
    Route::get('export_csv','MatterController@export_csv');
});

/* 権限管理ページ */
Route::group(['prefix' => 'auth', 'middleware' => ['auth']], function() {
    Route::get('all','AuthController@all');
    Route::get('create','AuthController@create');
    Route::post('create_check','AuthController@create_check');
    Route::get('create_check','AuthController@create_check');
    Route::post('create_add','AuthController@create_add');
    Route::get('create_add','AuthController@create_add');
    Route::get('edit','AuthController@edit');
    Route::post('edit_check','AuthController@edit_check');
    Route::get('edit_check','AuthController@edit_check');
    Route::post('update','AuthController@update');
    Route::get('update','AuthController@update');
    Route::get('delete','AuthController@delete');
});

/* 従業員アカウント管理ページ */

Route::group(['prefix' => 'user', 'middleware' => ['auth']], function() {
    Route::get('all','UserController@all');
    Route::post('all','UserController@all');
    Route::get('create','UserController@create');
    Route::post('create','UserController@create');
    Route::post('create_check','UserController@create_check');
    Route::get('create_check','UserController@create_check');
    Route::post('create_add','UserController@create_add');
    Route::get('create_add','UserController@create_add');
    Route::get('edit','UserController@edit');
    Route::post('edit','UserController@edit');
    Route::post('edit_check','UserController@edit_check');
    Route::get('edit_check','UserController@edit_check');
    Route::post('update','UserController@update');
    Route::get('update','UserController@update');
    Route::get('delete','UserController@delete');
    Route::post('delete','UserController@delete');
    Route::get('pass_set', 'UserController@pass_set');
    Route::post('pass_reset', 'UserController@pass_reset');

    //キーワード検索
    Route::post('filter_search','UserController@filter_search');
    Route::get('filter_search','UserController@filter_search');

    //チェックボックス削除
    Route::post('check_delete/{value}','UserController@check_delete');
});

/* 操作ログページ */

Route::group(['prefix' => 'log', 'middleware' => ['auth']], function() {
    Route::get('all','LogController@all');
    Route::post('all','LogController@all');

    //キーワード検索
    Route::post('filter_search','LogController@filter_search');
    Route::get('filter_search','LogController@filter_search');
});

/* 顧客管理ページ */
Route::group(['prefix' => 'client', 'middleware' => ['auth']], function() {
    Route::get('all','ClientController@all');
    Route::post('all','ClientController@all');
    Route::get('all2','ClientController@all2');
    Route::post('all2','ClientController@all2');
    Route::get('create','ClientController@create');
    Route::post('create','ClientController@create');
    Route::post('create_check','ClientController@create_check');
    Route::get('create_check','ClientController@create_check');
    Route::post('create_add','ClientController@create_add');

    Route::get('detail','ClientController@detail');

    Route::get('edit','ClientController@edit');
    Route::post('edit','ClientController@edit');
    Route::post('edit_check','ClientController@edit_check');
    Route::get('edit_check','ClientController@edit_check');
    Route::post('update','ClientController@update');
    Route::get('update','ClientController@update');
    Route::get('delete','ClientController@delete');

    //ステータス
    Route::post('status_all','ClientController@client_status_all');
    Route::get('status_all','ClientController@client_status_all');
    Route::get('status_add','ClientController@client_status_add');
    Route::post('status_add','ClientController@client_status_add');
    Route::get('status_update','ClientController@client_status_update');
    Route::post('status_update','ClientController@client_status_update');
    Route::get('status_delete','ClientController@client_status_delete');
    Route::post('status_delete','ClientController@client_status_delete');

    //キーワード検索
    Route::post('filter_search','ClientController@filter_search');
    Route::get('filter_search','ClientController@filter_search');

    //顧客一覧→該当案件
    Route::get('matter','ClientController@matter');
    Route::post('matter_filter_search','ClientController@matter_filter_search');
    Route::get('matter_filter_search','ClientController@matter_filter_search');

    //顧客一覧→案件作成
    Route::get('client_matter_create','ClientController@client_matter_create');

    //csvインポート
    Route::get('csv_import','ClientController@csv_import_view');
    Route::post('csv_import_check','ClientController@csv_import_check');
    Route::get('csv_import_check','ClientController@csv_import_check');
    Route::post('csv_import_add', 'ClientController@csv_import_add');//大村追記
    Route::get('csv_import_add', 'ClientController@csv_import_add');
    
    //チェックボックス削除
    Route::post('check_delete/{value}','ClientController@check_delete');

    //プルダウン編集
    Route::post('check_edit/{value}/status_name/{status_name}/important_value/{important_value}/','ClientController@check_edit');

    //csvエクスポート
    Route::get('export_csv','ClientController@export_csv');

    //アンケートステータス変更
    Route::post('questionnaire_check_edit/{value}/questionnaire_target/{questionnaire_target}','ClientController@questionnaire_check_edit');
});

Route::group(['prefix' => 'status', 'middleware' => ['auth']], function() {
    Route::get('all','StatusController@matter_status_all');
    Route::get('add','StatusController@matter_status_add');
    Route::post('add','StatusController@matter_status_add');
    Route::get('update','StatusController@matter_status_update');
    Route::post('update','StatusController@matter_status_update');
    Route::get('delete','StatusController@matter_status_delete');
});

/* 調査会社関連 */
Route::group(['prefix' => 'survey_corp', 'middleware' => ['auth']], function() {
    Route::get('all','SurveyCorpController@all');
    Route::get('detail','SurveyCorpController@detail');
    Route::get('create','SurveyCorpController@create');
    Route::post('create_check','SurveyCorpController@create_check');
    Route::get('create_check','SurveyCorpController@create_check');
    Route::post('add','SurveyCorpController@add');
    Route::get('add','SurveyCorpController@add');
    Route::get('edit','SurveyCorpController@edit');
    Route::post('edit_check','SurveyCorpController@edit_check');
    Route::get('edit_check','SurveyCorpController@edit_check');
    Route::post('update','SurveyCorpController@update');
    Route::get('update','SurveyCorpController@update');
    Route::get('delete', 'SurveyCorpController@delete');
    Route::post('delete', 'SurveyCorpController@delete');
});

/* 業者関連 */
Route::group(['prefix' => 'trader', 'middleware' => ['auth']], function() {
    Route::get('all','TraderController@all');
    Route::get('detail','TraderController@detail');
    Route::get('create','TraderController@create');
    Route::post('create_check','TraderController@create_check');
    Route::get('create_check','TraderController@create_check');
    Route::post('add','TraderController@add');
    Route::get('add','TraderController@add');
    Route::get('edit','TraderController@edit');
    Route::post('edit_check','TraderController@edit_check');
    Route::get('edit_check','TraderController@edit_check');
    Route::post('update','TraderController@update');
    Route::get('update','TraderController@update');
    Route::get('delete','TraderController@delete');
    Route::post('Responsible','TraderController@Responsible');
    Route::get('Responsible','TraderController@Responsible');
    Route::post('surveycorp','TraderController@surveycorp');
    Route::get('surveycorp','TraderController@surveycorp');
    Route::post('reward','TraderController@reward');
    Route::get('reward','TraderController@reward');
    Route::post('search_reward','TraderController@search_reward');
    Route::get('search_reward','TraderController@search_reward');

    Route::post('img_add','TraderController@img_add');
    Route::get('img_add','TraderController@img_add');
    Route::get('img_del','TraderController@img_del');
    Route::get('img_download','TraderController@img_download');

    Route::get('delete','TraderController@delete');
    Route::get('edit','TraderController@edit');
    Route::post('edit_check','TraderController@edit_check');
    Route::get('edit_check','TraderController@edit_check');
    Route::post('update','TraderController@update');
    Route::get('update','TraderController@update');
    //キーワード検索
    Route::post('filter_search','TraderController@filter_search');
    Route::get('filter_search','TraderController@filter_search');
    //チェックボックス削除
    Route::post('check_delete/{value}','TraderController@check_delete');
    //報酬・詳細チェックボックス更新・削除
    Route::post('reward_check_edit/client_value/{client_value}/matter_value/{matter_value}/client_status_name/{client_status_name}/matter_status_name/{matter_status_name}','TraderController@reward_check_edit');
    Route::post('reward_check_delete/client_value/{client_value}/matter_value/{matter_value}','TraderController@reward_check_delete');
    //CSVエクスポート
    Route::get('export_csv','TraderController@export_csv');
    //CSVインポート
    Route::get('csv_import','TraderController@csv_import');
    //Route::post('csv_import','TraderController@csv_import');
    Route::get('csv_import_check','TraderController@csv_import_check');
    Route::post('csv_import_check','TraderController@csv_import_check');
    Route::post('Trader_import_add', 'TraderController@csv_import_add');
    Route::get('Trader_import_add', 'TraderController@csv_import_add');
});

/* 詳細検索 */
Route::group(['prefix' => 'search', 'middleware' => ['auth']], function() {
    Route::get('index','SearchController@index');
    Route::post('index','SearchController@index');
    Route::post('client','SearchController@client_result');
    Route::get('client','SearchController@client_result');
    Route::post('matter','SearchController@matter_result');
    Route::get('matter','SearchController@matter_result');
});

// ログインユーザーのアカウント情報 aoyagi
Route::group(['prefix' => 'account', 'middleware' => ['auth']], function () {
    Route::get('info', 'SurveyController@info');
    Route::post('info', 'SurveyController@info');
    Route::post('pass_reset', 'SurveyController@pass_reset');
    Route::get('pass_reset', 'SurveyController@pass_reset');
});

Route::group(['prefix' => 'progress', 'middleware' => ['auth']], function () {
    Route::get('index', 'ProgressController@index');
    Route::get('create', 'ProgressController@create');
    Route::post('add', 'ProgressController@add');
    Route::get('add', 'ProgressController@add');
    Route::post('edit', 'ProgressController@edit');
    Route::get('edit', 'ProgressController@edit');
    Route::get('delete','ProgressController@delete');
    Route::get('update','ProgressController@update');
});

//メール
Route::group(['prefix' => 'mail', 'middleware' => ['auth']], function() {
    Route::get('status_send','MailSendController@status_send');
    Route::post('status_send','MailSendController@status_send');
});