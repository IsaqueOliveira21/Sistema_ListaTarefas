<?php

namespace App\Http\Controllers;

use App\Exports\TarefasExport;
use App\Mail\NovaTarefaMail;
use App\Models\Tarefa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Excel;

class TarefaController extends Controller
{
    /*
    public function __construct()
    {
        $this->middleware('auth');
    }
    */

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        /*
        if (Auth::check()) { // outro metodo de verificar a autenticação do usuário. (outra forma para usar o auth é: auth()->chech())
            $id = Auth::user()->id;
            $name = Auth::user()->name;
            $email = Auth::user()->email;

            return "ID: $id | Name: $name | Email: $email";
        } else {
            return 'Você não está logado!';
        }
        */
        $user_id = Auth::user()->id;
        $tarefas = Tarefa::where('user_id', $user_id)->paginate(10);
        return view('tarefas.index', compact('tarefas'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tarefas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dados = $request->all('tarefa', 'data_limite_conclusao');
        $dados['user_id'] = Auth::user()->id;
        //dd($dados);
        $destinatario = Auth::user()->email;
        $tarefa = Tarefa::create($dados);
        Mail::to($destinatario)->send(new NovaTarefaMail($tarefa));
        return redirect()->route('tarefa.show', compact('tarefa'));
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Tarefa $tarefa
     * @return \Illuminate\Http\Response
     */
    public function show(Tarefa $tarefa)
    {
        return view('tarefas.show', compact('tarefa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Tarefa $tarefa
     * @return \Illuminate\Http\Response
     */
    public function edit(Tarefa $tarefa)
    {
        $user_id = Auth::user()->id;
        if ($tarefa->user_id == $user_id) {
            return view('tarefas.edit', compact('tarefa'));
        } else {
            return view('acesso-negado');
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tarefa $tarefa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarefa $tarefa)
    {
        $user_id = Auth::user()->id;
        if ($tarefa->user_id == $user_id) {
            $tarefa->update($request->all());
            return redirect()->route('tarefa.index');
        } else {
            return view('acesso-negado');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Tarefa $tarefa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tarefa $tarefa)
    {
        $user_id = Auth::user()->id;
        if ($tarefa->user_id == $user_id) {
            $tarefa->delete();
            return redirect()->route('tarefa.index');
        } else {
            return view('acesso-negado');
        }
    }


    public function exportacao($extensao)
    {
        if ($extensao == 'xlsx') {
            return \Maatwebsite\Excel\Facades\Excel::download(new TarefasExport, 'tarefas.xlsx');
        } elseif ($extensao == 'csv') {
            return \Maatwebsite\Excel\Facades\Excel::download(new TarefasExport, 'tarefas.csv');
        } elseif ($extensao == 'pdf') {
            return \Maatwebsite\Excel\Facades\Excel::download(new TarefasExport, 'tarefas.pdf');
        } else {
            return redirect()->route('tarefa.index');
        }

    }
}


