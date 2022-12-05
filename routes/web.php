<?php

use App\Http\Controllers\Admin\Web\CommodityController;
use App\Http\Controllers\Admin\Web\RemittanceController;
use Illuminate\Support\Facades\Auth;
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

Route::middleware('auth')->get('/', function () {
    return view('Admin.master');
});

Route::get('loginPage', [App\Http\Controllers\HomeController::class, 'loginPage'])->name('user.loginPage');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout.perform');


Route::group(['middleware' => 'auth'], function () {
    Route::resource('commodities', CommodityController::class);
    Route::resource('remittances', RemittanceController::class);

});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
