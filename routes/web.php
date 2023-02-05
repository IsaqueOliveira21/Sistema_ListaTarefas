<?php

use App\Mail\MensagemTesteMail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('bem-vindo');
});

Auth::routes(['verify' => true]); // indica que na inserçao de usuarios queremos realizar a verificação de email


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])
    ->name('home')
    ->middleware('verified');

Route::resource('tarefa', 'App\Http\Controllers\TarefaController')->middleware('verified'); //->middleware('auth');

Route::get('/mensagem-test', function () {
    return new MensagemTesteMail();
    //Mail::to('isaque16.oliveira@gmail.com')->send(new MensagemTesteMail()); // Pode ser utilizado no tinker tambem
    //return 'E-mail enviado com sucesso!';
});
