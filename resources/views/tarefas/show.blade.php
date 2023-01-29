@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $tarefa->tarefa }}</div>
                    <div class="card-body">
                        <fieldset disabled>
                            <div class="mb-3">
                                <label class="form-label">Data Limite de Conclusao</label>
                                <input type="text" class="form-control" value="{{$tarefa->data_limite_conclusao}}">
                            </div>
                        </fieldset>
                        <a href="{{url()->previous()}}" class="btn btn-primary" role="button">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
