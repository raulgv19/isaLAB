<?php

use App\Http\Controllers\ActivityAdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservationController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Redirect;

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
    return redirect('/login');
});

Route::resource('/reserva', ReservationController::class)->except(['index','show'])->middleware(['auth','socio']);
Route::resource('/dashboard', DashboardController::class)->except(['show'])->middleware(['auth']);
Route::resource('/admin/users', UserController::class)->only(['index','edit','update'])->middleware(['auth','admin']);
Route::resource('/admin/activities', ActivityAdminController::class)->except(['show'])->middleware(['auth','admin']);
//Route::resource('users', UserController::class)->except(['show'])->middleware(['auth','socio']);

Route::get('logout', function ()
{
    auth()->logout();
    Session()->flush();

    return Redirect::to('/login');
})->name('logout')->middleware('auth');



require __DIR__.'/auth.php';
