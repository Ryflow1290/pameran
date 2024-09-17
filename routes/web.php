<?php

use App\Http\Controllers\BannersController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\PameranController;
use App\Http\Controllers\RatingController;

use App\Models\Banner;
use App\Models\Jurusan;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    $banners = Banner::where('is_active', true)->get();
    $jurusans = Jurusan::with('pamerans.user', 'pamerans.files')->get();
    return view('welcome')->with(compact('jurusans'))->with(compact('banners'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/users', 'UsersController@index')->name('users');
Route::get('/users/data', 'UsersController@getUsersData')->name('users.data');
Route::get('/users/edit/{id}', 'UsersController@editUsersData')->name('users.edit');
Route::put('/users/edit/{id}', 'UsersController@updateUsersData')->name('users.edit');
Route::get('/users/delete/{id}', 'UsersController@deleteUsersData')->name('users.delete');
Route::get('/pameran/data', [PameranController::class, 'data'])->name('pameran.data');
Route::get('/jurusan/data', [JurusanController::class, 'data'])->name('jurusan.data');
Route::resource('pameran', PameranController::class);
Route::resource('jurusan', JurusanController::class);
Route::resource('/banners', BannersController::class);

Route::get('ratings', [RatingController::class, 'index'])->name('ratings.index');
Route::post('ratings', [RatingController::class, 'store'])->name('ratings.store');
Route::get('ratings/{id}/edit', [RatingController::class, 'edit'])->name('ratings.edit');
Route::put('ratings/{id}', [RatingController::class, 'update'])->name('ratings.update');
Route::delete('ratings/{id}', [RatingController::class, 'destroy'])->name('ratings.destroy');

Route::patch('/banners/{id}/toggle-status', [BannersController::class, 'toggleStatus'])->name('banners.toggleStatus');


Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');
