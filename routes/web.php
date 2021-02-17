<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Models\User;
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

//Auth::routes();

// Route::group(['middleware'=>['auth']], function () {
//     Route::get('/user', 'DemoController@userDemo')->name('user');
//     Route::group(['middleware'=>['admin']], function () {
//         Route::get('/admin', 'DemoController@adminDemo')->name('admin');
//     });
// });


Route::group(['middleware'=>['auth']], function () {
    Route::get('/user', function () {
        return view('user');
    });

    Route::group(['middleware'=>['lekarz']], function () {
        Route::get('/lekarz', function () {
            return view('lekarz');
        })->name('lekarz');
    });

    Route::group(['middleware'=>['recepcja']], function () {
        Route::get('/recepcja', function () {
            return view('recepcja');
        });
    });


    Route::group(['middleware'=>['admin']], function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');

        Route::get('/admin/remove-admin/{userId}', [AdminController::class, 'removeAdmin']);
        Route::get('/admin/give-admin/{userId}', [AdminController::class, 'giveAdmin']);

        Route::get('/admin/remove-lekarz/{userId}', [AdminController::class, 'removeLekarz']);
        Route::get('/admin/give-lekarz/{userId}', [AdminController::class, 'giveLekarz']);

        Route::get('/admin/remove-recepcja/{userId}', [AdminController::class, 'removeRecepcja']);
        Route::get('/admin/give-recepcja/{userId}', [AdminController::class, 'giveRecepcja']);
    });

        //poprzednia działająca funkcja bez użycia kontrolera
    // Route::group(['middleware'=>['admin']], function () {
    //     Route::get('/admin', function () {
    //         return view('admin');
    //     });
    // });



});

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('home');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/', function () {
    return view('home');
})->name('home');
