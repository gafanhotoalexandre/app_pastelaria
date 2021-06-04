<?php

use App\Mail\TesteMail;
use Illuminate\Support\Facades\Mail;
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
    return view('welcome');
});

Route::get('/mensagem-teste', function () {
    return new TesteMail();
    // Mail::to('alexandrevmartinsdelima@gmail.com')->send(new TesteMail());
    // return 'Email enviado com sucesso!';
});
