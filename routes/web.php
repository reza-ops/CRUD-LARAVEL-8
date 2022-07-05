<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\BookController;
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

Route::get('/', function () {
    return redirect(route('login'));
});

// custom redirec loggin
Route::post('logged_in', [LoginController::class, 'authenticate'])->name('logged_in');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group([
    'prefix'    => 'master',
    'as'        => 'master.',
    ], function () {
        Route::resource('books', BookController::class)->except('show','destroy');
        Route::get('books/get_data', [BookController::class, 'getData'])->name('books.get_data');
        Route::get('books/delete/{data_id}', [BookController::class, 'delete'])->name('books.delete');
    }
);
