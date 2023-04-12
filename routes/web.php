<?php

use App\Http\Controllers\AsignController;
use App\Http\Controllers\ConteosController;
use App\Http\Controllers\CopyController;
use Illuminate\Support\Facades\Route;
use app\Models\Roles;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContController;
use App\Http\Controllers\InformesController;
use App\Http\Controllers\ProfileController;

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
    return redirect()->route('home');
})->middleware('auth');

Auth::routes();

Route::resources([
    'user' => UserController::class,
    'copia' => CopyController::class,
    'asignar' => AsignController::class,
    'conteos' => ConteosController::class,
]);





Route::get('/Asignc3/{id}', [AsignController::class, 'Asignation3'])->name('Asignc3');
Route::post('/storeAs3/{id}', [AsignController::class, 'storeAs3'])->name('storeAs3');

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/contar/{id}', [HomeController::class, 'edit'])->name('contar');

Route::get('/Ubicaciones/{id}/{ncount}', [ContController::class, 'FormUbi'])->name('Ubicaciones');
Route::post('/searchubi/{id}', [ContController::class, 'ubiSearch'])->name('buscarUbicacion');


Route::get('/newprod/{id}', [ContController::class, 'FormNewProd'])->name('newprod');
Route::post('/storenewprod/{id}', [ContController::class, 'storeNewProd'])->name('storenewprod');

Route::post('/countAgre/{id}', [ContController::class, 'countAgre'])->name('countAgre');
Route::get('/formnew/{id}', [ContController::class, 'Agre'])->name('formnew');
Route::post('/StoreAgre/{id}', [ContController::class, 'StoreAgre'])->name('StoreAgre');


Route::get('/lista/{id}', [ContController::class, 'Lista'])->name('lista');
Route::get('/change/{id}', [ConteosController::class, 'ChangeState'])->name('changestate');


Route::get('/infomes', [InformesController::class, 'index'])->name('informes');
Route::post('/export', [InformesController::class, 'export'])->name('export');


Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('edit');
Route::post('/storeEdit/{id}', [ProfileController::class, 'update'])->name('storeEdit');
Route::post('/updatePass/{id}', [ProfileController::class, 'updatePass'])->name('updatePass');
