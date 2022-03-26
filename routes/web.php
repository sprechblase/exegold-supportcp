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

Route::get('/', 'DashboardController@home')->name('home');

Route::get('/permissioninit', 'DashboardController@permissioninit')->name('permissioninit');

Route::get('/locked', function() {
	return view('locked');
})->name('redirect_account_locked');

//Supportfälle
Route::get('/supportfall/list/{type}', 'SupportcaseController@list')->name('supportcase.list');
Route::get('/supportfall/delete/{id}', 'SupportcaseController@delete')->name('supportcase.delete');
Route::get('/supportfall/edit/{id}', 'SupportcaseController@edit')->name('supportcase.edit');
Route::get('/supportfall/create', 'SupportcaseController@create')->name('supportcase.create');

Route::get('/supportfall/ajax/{id}', 'SupportcaseController@ajax')->name('supportcase.ajax');

Route::post('/supportfall/edit/{id}', 'SupportcaseController@edit')->name('supportcase.edit.post');
Route::post('/supportfall/create', 'SupportcaseController@create')->name('supportcase.create.post');

//Banprotokoll
Route::get('/banprotokoll/list', 'BanprotokollController@list')->name('banprotokoll.list');
Route::get('/banprotokoll/delete/{id}', 'BanprotokollController@delete')->name('banprotokoll.delete');
Route::get('/banprotokoll/edit/{id}', 'BanprotokollController@edit')->name('banprotokoll.edit');
Route::get('/banprotokoll/create', 'BanprotokollController@create')->name('banprotokoll.create');

Route::get('/banprotokoll/ajax/{id}', 'BanprotokollController@ajax')->name('banprotokoll.ajax');

Route::post('/banprotokoll/edit/{id}', 'BanprotokollController@edit')->name('banprotokoll.edit.post');
Route::post('/banprotokoll/create', 'BanprotokollController@create')->name('banprotokoll.create.post');

//Banprotokoll
Route::get('/doc/open/{id}', 'DocController@open')->name('doc.open');
Route::get('/doc/list', 'DocController@list')->name('doc.list');
Route::get('/doc/delete/{id}', 'DocController@delete')->name('doc.delete');
Route::get('/doc/edit/{id}', 'DocController@edit')->name('doc.edit');
Route::get('/doc/create', 'DocController@create')->name('doc.create');
Route::get('/doc/team', 'DocController@team')->name('doc.team');

Route::post('/doc/edit/{id}', 'DocController@edit')->name('doc.edit.post');
Route::post('/doc/create', 'DocController@create')->name('doc.create.post');

//Logs
Route::get('/log/list', 'LogController@list')->name('log.list');
Route::get('/log/ajax/{id}', 'LogController@ajax')->name('log.ajax');

//Positions
Route::get('/position/list', 'PositionController@list')->name('position.list');
Route::get('/position/delete/{id}', 'PositionController@delete')->name('position.delete');
Route::get('/position/edit/{id}', 'PositionController@edit')->name('position.edit');
Route::get('/position/create', 'PositionController@create')->name('position.create');

Route::post('/position/edit/{id}', 'PositionController@edit')->name('position.edit.post');
Route::post('/position/create', 'PositionController@create')->name('position.create.post');

//Users
Route::get('/user/list', 'UserController@list')->name('user.list');
Route::get('/user/delete/{id}', 'UserController@delete')->name('user.delete');
Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit');
Route::get('/user/selfedit', 'UserController@selfedit')->name('user.selfedit');
Route::get('/user/create', 'UserController@create')->name('user.create');
Route::get('/user/info/{id}', 'UserController@info')->name('user.info');

Route::post('/user/edit/{id}', 'UserController@edit')->name('user.edit.post');
Route::post('/user/create', 'UserController@create')->name('user.create.post');
Route::post('/user/selfedit', 'UserController@selfedit')->name('user.selfedit.post');
