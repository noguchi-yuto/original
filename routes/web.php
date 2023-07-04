<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;


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

Route::get('/', [BooksController::class,'index']);

Route::get('/dashboard', [BooksController::class,'index'])->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('name_update',[ProfileController::class, 'name_update'])->name('profile.nameUpdate');
    Route::put('email_update',[ProfileController::class, 'email_update'])->name('profile.emailUpdate');
    Route::get('/profile',[ProfileController::class,'index'])->name('profile.index');
    Route::resource('books',BooksController::class);
    Route::group(['prefix'=>'books/{id}'],function(){
       Route::put('info_update',[BooksController::class,'info_update'])->name('books.infoUpdate');
       Route::put('number_fluctuation_plus',[BooksController::class,'number_fluctuation_plus'])->name('books.numberFluctuationPlus');
       Route::put('number_fluctuation_minus',[BooksController::class,'number_fluctuation_minus'])->name('books.numberFluctuationMinus');
    });
    Route::get('/',[BooksController::class,'index'])->name('books.index');
    Route::get('getDataTablesData',[BooksController::class,'getDataTablesData'])->name('books.getData');
});

require __DIR__.'/auth.php';


