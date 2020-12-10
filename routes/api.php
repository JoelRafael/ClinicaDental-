<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ServicioController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['jwt.auth'], 'prefix' =>'v1'], function(){
Route::post('/refresh', [UserController::class, 'refreshtoken']);
Route::get('/login/expire', [UserController::class, 'expire']);
Route::post('/creapaciente', [PacienteController::class, 'store']);


});
Route::post('crearuser', [UserController::class, 'Createuser']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/oneline', [UserController::class, 'veroneline']);
Route::get('verservicios', [ServicioController::class, 'verservicios']);
Route::post('nuevoservicio', [ServicioController::class, 'nuevoservicio']);
