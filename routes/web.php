<?php

use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('tarefa', 'App\Http\Controllers\TarefaController'); //->middleware('auth');

Route::get('/mensagem-test', function () {
    return new MensagemTesteMail();
    //Mail::to('isaque16.oliveira@gmail.com')->send(new MensagemTesteMail()); // Pode ser utilizado no tinker tambem
    //return 'E-mail enviado com sucesso!';
});
