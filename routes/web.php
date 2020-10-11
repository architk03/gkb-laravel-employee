<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::middleware('auth')->group(function()
{
Route::get('/employee','employee_controller@index');
Route::post('/addimage','employee_controller@store')->name('addimage');
Route::resource('Demo','employee_datatable');
// Route::post('Demo/store','employee_datatable@store');
// Route::post('Demo/edit','employee_datatable@edit');
Route::post('Demo/update', 'employee_datatable@update')->name('Demo.update');
Route::get('Demo/destroy/{id}', 'employee_datatable@destroy');
Route::get('Demo/import','employee_datatable@importCSV');
Route::post('Demo/import/save','employee_dattable@saveCSVData')->name('employees.saveCSVData');

});


