@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Tarefas
                            </div>
                            <div class="col-6">
                                <div class="float-right">
                                    <a href="{{route('tarefa.create')}}" class="mr-2">Novo</a>
                                    <a href="{{ route('tarefa.exportacao') }}">XLSX</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" class="text-center">Nº</th>
                                <th scope="col" class="text-center">Tarefa</th>
                                <th scope="col" class="text-center">Data limite conclusão</th>
                                <th class="text-center">-</th>
                                <th class="text-center">-</th>
                            </tr>
                            </thead>

                            <tbody>
                            @forelse($tarefas as $k => $tarefa)
                                <tr>
                                    <th scope="row" class="text-center">{{$tarefa->id}}</th>
                                    <td>{{$tarefa->tarefa}}</td>
                                    <td class="text-center">{{date('d/m/Y', strtotime($tarefa->data_limite_conclusao))}}</td>
                                    <td class="text-center">
                                        <a href="{{ route('tarefa.edit', $tarefa->id) }}" class="btn btn-primary"
                                           role="button">Editar</a>
                                    </td>
                                    <td class="text-center">
                                        <form id="form_{{$tarefa->id}}" method="POST"
                                              action="{{ route('tarefa.destroy', $tarefa->id) }}">
                                            @method('DELETE')
                                            @csrf
                                        </form>
                                        <a class="btn btn-danger" role="button" href="#"
                                           onclick="document.getElementById('form_{{$tarefa->id}}').submit()">Excluir</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Não há registro de tarefas</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>

                        <nav>
                            <ul class="pagination">
                                <li class="page-item"><a class="page-link" href="{{ $tarefas->previousPageUrl() }}">Anterior</a>
                                </li>
                                @for($i = 1; $i <= $tarefas->lastPage(); $i++)
                                    <li class="page-item {{ $tarefas->currentPage() == $i ? 'active' : '' }}"><a
                                            class="page-link" href="{{ $tarefas->url($i) }}">{{ $i }}</a></li>
                                @endfor
                                <li class="page-item"><a class="page-link"
                                                         href="{{ $tarefas->nextPageUrl() }}">Próximo</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
