<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\Computador;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $computador = Computador::find($id);
        if ($computador == null) {
            abort(404);
        }

        return view('computador.comentario.create')->with('comentarios', $computador->comentarios)->with('compu_id', $id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($computer_id, Request $req)
    {
        $req->validate([
            'comentario' => 'max:255'
        ]);
        $comentario = new Comentario;
        $computador = Computador::find($computer_id);
        $comentario->comentario = $req->comentario;
        $comentario->computador()->associate($computador);
        $comentario->save();
        return redirect(route('addcomentario', $computer_id));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function show(Comentario $comentario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comentario = Comentario::find($id);
        if ($comentario == null) {
            abort(404);
        }
        $computador = Computador::find($comentario->computador->id);
        return view('computador.comentario.edit')->with('comentario', $comentario)
            ->with('computador', $computador);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req,$id)
    {
        $comentario = Comentario::find($id);
        if ($comentario == null) {
            abort(404);
        }
        $req->validate([
            'comentario' => 'max:255'
        ]);
        $comentario->comentario = $req->comentario;
        $comentario->save();
        return redirect(route('addcomentario', $comentario->computador_id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comentario  $comentario
     * @return \Illuminate\Http\Response
     */
    public function destroy($computer_id, $id)
    {
        $comentario = Comentario::find($id);
        $comentario->estado=false;
        return redirect(route('show', $computer_id));
    }
}
