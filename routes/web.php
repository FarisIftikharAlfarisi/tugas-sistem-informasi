<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MovieManagementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//login and logout
Route::get('/sign-in',[AuthenticationController::class,'signin'])->name('sign-in');
Route::post('/login-process',[AuthenticationController::class,'authenticate'])->name('login-process');
Route::get('/logout',[AuthenticationController::class,'logout'])->name('sign-out');
//end login and logout

//route for admin
Route::group(['middleware'=>['auth', 'role:Admin']],function () {
    Route::get('/dashboard',[ManagerController::class,'index'])->name('dashboard_manager');
    Route::get('/create-account',[ManagerController::class,'create_account'])->name('create-account');
});
//end of route

//route for role Movie Officer
Route::group(['middleware'=>['auth', 'role:Movie Officer']],function () {
    Route::get('/dasboard/cinema',[MovieManagementController::class,'index'])->name('movie-index');
});
//end of route

//route for Cashier
Route::group(['middleware'=>['auth', 'role:Cashier']],function () {
    Route::get('/dasboard/cashier/',[CashierController::class,'index'])->name('cashier-index');
    Route::get('/dasboard/cashier/order',[CashierController::class,'order'])->name('cashier-order');
    Route::post('/dasboard/cashier/order-process',[CashierController::class,'save_order'])->name('cashier-order-process');
});
//end of route
