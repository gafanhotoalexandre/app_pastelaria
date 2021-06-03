<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PastelController;
use App\Http\Controllers\PedidoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/', function () {
    return ['Chegamos ate aqui' => 'SIM'];
});

Route::apiResource('cliente', ClienteController::class);
Route::apiResource('pastel', PastelController::class);
Route::apiResource('pedido', PedidoController::class);