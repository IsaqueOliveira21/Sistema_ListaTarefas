@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Confirme seu E-mail!</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Enviamos uma nova confirmacao para seu e-mail.
                        </div>
                    @endif

                    Voce precisa confirmar seu e-mail antes de prosseguir.
                    Caso nao tenha recebido o e-mail,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">clique aqui para reenviar a confirmacao.</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
