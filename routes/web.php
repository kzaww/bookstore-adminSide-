<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authController;
use App\Http\Controllers\bookController;
use App\Http\Controllers\userController;
use App\Http\Controllers\gerneController;
use App\Http\Controllers\authorController;
use App\Http\Controllers\accountController;
use App\Http\Controllers\dashboardController;

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


route::middleware('loginCheck')->group(function(){
    Route::redirect('/','loginPage');
    route::get('loginPage',[authController::class,'loginPage']);

    route::get('registerPage',[authController::class,'registerPage']);
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified'])->group(function () {
    route::get('check',[authController::class,'dashboard']);

    route::middleware('adminCheck')->group(function(){
        //dashboard
        route::get('dashboard',[dashboardController::class,'dashboard'])->name('admin#dashboard');
        //gernes
        route::controller(gerneController::class)->prefix('gernes')->group(function(){
            route::get('list','list')->name('admin#gerneList');
            route::post('ajax/create','create')->name('admin#gerneCreate');
            route::post('ajax/delete','delete')->name('admin#gerneDelete');
            route::post('ajax/update','update')->name('admin#gerneUpdate');
            route::get('ajax/search','search')->name('admin#gerneSearch');
        });

        //author
        route::controller(authorController::class)->prefix('author')->group(function(){
            route::get('list','list')->name('admin#authorList');
            route::post('ajax/create','create')->name('admin#authorCreate');
            route::post('ajax/delete','delete')->name('admin#authorDelete');
            route::post('ajax/update','update')->name('admin#authorUpdate');
            route::get('ajax/search','search')->name('admin#authorSearch');
        });

        //books
        route::controller(bookController::class)->prefix('book')->group(function(){
            route::get('list','list')->name('admin#bookList');
            route::post('ajax/create','create')->name('admin#bookCreate');
            route::post('ajax/delete','delete')->name('admin#bookDelete');
            route::post('ajax/update','update')->name('admin#bookUpdate');
            route::get('ajax/gen_search','gen_search')->name('admin#gen_search');
            route::get('ajax/author_search','author_search')->name('admin#author_search');
            route::get('ajax/book_auto','book_auto')->name('admin#book_auto');
            route::post('ajax/bookSearch','bookSearch')->name('admin#bookSearch');
            route::post('ajax/bookTotal','bookTotal')->name('admin#bookTotal');
        });

        //account
        route::controller(accountController::class)->prefix('account')->group(function(){
            route::get('/','list')->name('admin#account');
            route::post('ajax/accPhoto','photo')->name('admin#accountPhoto');
            route::post('ajax/editProfile','update')->name('admin#accountUpdate');
            route::post('ajax/changePassword','changePassword')->name('admin#changePassword');
        });
    });


    route::middleware('userCheck')->prefix('user')->group(function(){
        route::get('home',[userController::class,'home'])->name('user#home');
    });
});
