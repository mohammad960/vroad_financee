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




Route::get('/newDesign', function () {
    return view('history.najib');
});
Route::get('/linkStorage', function () {
    Artisan::call('storage:link');

});

Route::get('balance/getecxel','ExportController@generateFile' );

Route::middleware(['Authin'])->group(function (){
	Route::get('/','boxController@details');
	Route::get('/home','boxController@details');


	Route::resource('role','roleController');
    Route::resource('user','userController');

	Route::get('pagination-user',"userController@pagination_ajax");
	Route::get('user/{id}/destroy','userController@destroy');
    Route::get('user/{id}/delete','userController@delete');

    Route::get('user/{id}/show','userController@show')->name('user.show');;

	Route::resource('market','marketController');
	Route::get('market/{id}/destroy','marketController@destroy');
	Route::get('pagination-market',"marketController@pagination_ajax");

	Route::resource('box','boxController');
	Route::get('box/{id}/destroy','boxController@destroy');
	Route::get('pagination-box',"boxController@pagination_ajax");
	Route::get('box/{id}/show','boxController@show');
	Route::get('box/{id}/disable','boxController@disable');
	Route::get('details','boxController@details')->name('details');
	Route::get('pagination-show',"boxController@pagination_show");
	Route::get('balance','balanceController@balance');
	Route::get('balance/sheet','balanceController@sheet');
	Route::get('pagination-balance',"balanceController@pagination_balance");
	Route::get('archive','archiveController@archive')->name('archive');
	Route::get('archive/create','archiveController@create')->name('archive.create');
	Route::get('pagination-archive',"archiveController@pagination_archive");
	Route::post('archiveStore','archiveController@store')->name('archive.store');
	Route::get('archive/{id}/restore','archiveController@restore');
	Route::get('child','historyController@child');

    Route::get('viewCost','historyController@viewCost')->name('viewCost');
	Route::post('saveCost','historyController@saveCost')->name('saveCost');


	Route::get('chartBar','boxController@chartBar');
	Route::get('chartLine','boxController@chartLine');
	Route::get('chartPie','boxController@chartPie');


	Route::resource('box_market','boxMarketController');
	Route::get('box_market/{id}/destroy','boxMarketController@destroy');
	Route::get('pagination-box_market',"boxMarketController@pagination_ajax");

	Route::resource('good','goodController');
	Route::get('good/{id}/destroy','goodController@destroy');
	Route::get('pagination-good',"goodController@pagination_ajax");
	Route::get('detailsGood',"goodController@details")->name('detailsGood');

	Route::resource('type_cost','typeCostController');
	Route::get('type_cost/{id}/destroy','typeCostController@destroy');
	Route::get('pagination-type_cost',"typeCostController@pagination_ajax");

	Route::resource('cost','costController');
	Route::get('cost/{id}/destroy','costController@destroy');
	Route::get('pagination-cost',"costController@pagination_ajax");
	Route::get('create_parent','costController@create_parent')->name('cost.create_parent');

	Route::get('expense','costController@expense')->name('cost.expense');
	Route::get('revenue','costController@revenue')->name('cost.revenue');
	Route::get('pagination-rev',"costController@pagination_rev");
	Route::get('pagination-exp',"costController@pagination_exp");
	Route::get('expense/parent','costController@expense_parent');
	Route::get('revenue/parent','costController@revenue_parent');
	Route::get('revenue/pagination-rev-parent',"costController@pagination_rev_parent");
	Route::get('expense/pagination-exp-parent',"costController@pagination_exp_parent");



	Route::resource('history','historyController');
	Route::get('history/{id}/destroy','historyController@destroy');
	Route::get('history/{id}/change','historyController@change');

	Route::get('pagination-history',"historyController@pagination_ajax");
	Route::post('answareA',"historyController@cat_cost")->name('answareA');
	Route::post('answareB',"historyController@answare")->name('answareB');
	Route::post('answareC',"historyController@box")->name('answareC');

	Route::post('salary',"historyController@salary")->name('salary');
	Route::get('salary/{id}/destroy','salaryController@destroy');
	Route::get('pagination-salary',"salaryController@pagination_ajax");


	Route::resource('employee','employeeController');
	Route::get('employee/{id}/destroy','employeeController@destroy');
	Route::get('pagination-employee',"employeeController@pagination_ajax");

	Route::resource('work','workController');
	Route::get('work/{id}/destroy','workController@destroy');
	Route::get('pagination-work',"workController@pagination_ajax");
	Route::get('work/{id}/pay',"workController@pay");
	Route::get('work/{id}/pay_ajax',"workController@pay_ajax");

	Route::post('workA',"workController@work_state")->name('workA');
	Route::post('workB',"workController@employee")->name('workB');


	Route::resource('debit','debitController');
	Route::get('debit/{id}/destroy','debitController@destroy');
    Route::get('debit/{id}/edit','debitController@edit');
	Route::get('pagination-debit',"debitController@pagination_ajax");

	Route::resource('message','messageController');
	Route::get('message/{id}/destroy','messageController@destroy');
	Route::get('pagination-message',"messageController@pagination_ajax");
	Route::get('message/change/{id}','messageController@change');


});





Auth::routes();
Route::get('logout','Auth\loginController@logout');
