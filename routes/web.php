<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\MovieManagementController;
use App\Http\Controllers\FilmController;
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

    Route::get('/dashboard/movies',[ManagerController::class,'movies_view'])->name('movie-list');
    Route::get('/dashboard/schedule',[ManagerController::class,'schedule_view'])->name('schedule-list');

    Route::get('/dashboard/movies/all',[ManagerController::class,'all_movies'])->name('all-movie');
    Route::get('/dashboard/schedule/all',[ManagerController::class,'all_schedule'])->name('all-schedule');

    //updating movie approval
    Route::post('/update-movie-approval/{id}',[ManagerController::class,'update_status_approval'])->name('update-status-approval-film');

    //updating schedule approval
    Route::post('/update-schedule-approval/{id}',[ManagerController::class,'update_status_approval_schedule'])->name('update-status-approval-schedule');
});
//end of route

//route for role Movie Officer
Route::group(['middleware'=>['auth', 'role:Movie Officer']],function () {

    //movie
    Route::resource('/dashboard/movie/movies',FilmController::class);
    Route::get('/dashboard/movie',[FilmController::class,'index'])->name('movie-index');
    Route::get('/dashboard/movie/movies',[FilmController::class,'movies'])->name('movie-movies');
    Route::get('/dashboard/movie/new-movies',[FilmController::class,'create'])->name('movie-new-movies');
    Route::post('/dashboard/movie/store-process',[FilmController::class,'store'])->name('store-movie');
    Route::get('/dashboard/movie/edit-movies/{id}',[FilmController::class,'edit'])->name('movie-edit-movies');
    Route::get('/dashboard/movie/delete-movies/{id}',[FilmController::class,'destroy'])->name('movie-delete-movies');
    //end movie

    //theater
    Route::resource('/dashboard/movie/theater', MovieManagementController::class);
    Route::get('/dashboard/movie/theater',[MovieManagementController::class,'theater'])->name('movie-theater');
    Route::get('/dashboard/movie/new-theater',[MovieManagementController::class,'create_theater'])->name('movie-new-theater');
    Route::post('/dashboard/movie/new-theater',[MovieManagementController::class,'store_theater'])->name('store-theater');
    Route::get('/dashboard/movie/edit-theater/{id}',[MovieManagementController::class,'edit_theater'])->name('movie-edit-theater');
    //end theater

    //schedule
    Route::get('dashboard/movie/schedule',[MovieManagementController::class,'schedule'])->name('schedule-index');
    Route::get('dashboard/movie/schedule/new-schedule',[MovieManagementController::class,'create_schedule'])->name('schedule-new-schedules');
    Route::post('dashboard/movie/schedule/store-schedule',[MovieManagementController::class,'store_schedule'])->name('store-schedule');
    Route::get('dashboard/movie/schedule/edit-schedule/{id}',[MovieManagementController::class,'edit_schedule'])->name('edit-schedule');
    Route::put('dashboard/movie/schedule/update-schedule/{id}',[MovieManagementController::class,'update_schedule'])->name('update-schedule');
    Route::delete('dashboard/movie/schedule/delete-schedule/{id}',[MovieManagementController::class,'delete_schedule'])->name('delete-schedule');

    Route::get('get_movies',[MovieManagementController::class,'get_movies'])->name('schedule-getMovies');
    Route::get('get_studio',[MovieManagementController::class,'get_studio'])->name('schedule-getStudio');
    //end schedule
});
//end of route

//route for Cashier
Route::group(['middleware'=>['auth', 'role:Cashier']],function () {
    Route::get('/dasboard/cashier/',[CashierController::class,'index'])->name('cashier-index');
    Route::get('/dasboard/cashier/order',[CashierController::class,'order'])->name('cashier-order');
    Route::get('/dasboard/cashier/order-seat/{id}',[CashierController::class,'order_seat'])->name('cashier-order-seat');
    Route::post('/dasboard/cashier/order-process',[CashierController::class,'save_order'])->name('cashier-order-process');
});
//end of route
//aksakka