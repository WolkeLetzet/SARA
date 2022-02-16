<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Oficina;
use App\Models\TipoUso;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Comentario;
use App\Models\Computador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ComputadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $search = trim($req->search);
        if ($search) {
            $data = Computador::where('estado', '=', '1')->whereHas('oficinas', function ($query) use ($search) {
                return $query->where('nombre', 'LIKE', "%$search%");
            })->orWhere('encargado', 'LIKE', "%$search%")
                ->with('oficinas')
                ->with('tipo_usos')
                ->with('comentarios')
                ->paginate(10);
            $data->appends(['search' => $search]);
        } else {
            $data = Computador::where('estado', '=', '1')
                ->with('oficinas')
                ->with('tipo_usos')
                ->with('comentarios')->paginate(10);
        }

        return view('computador.index')->with('computers', $data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $oficinas = Oficina::all();
        $tipo_usos = TipoUso::all();
        $marcas = DB::table('computadores')->select('marca')->distinct()->get();
        $sos = DB::table('computadores')->select('so')->distinct()->get();
        return view('computador.create')->with('oficinas', $oficinas)
            ->with('tipo_usos', $tipo_usos)
            ->with('marcas', $marcas)
            ->with('sos', $sos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $computador = new Computador;

        $req->validate([
            'modelo' => 'required|max:255',
            'fecha' => 'required|date',
            'marca' => 'required|max:255',
            'ram' => 'max:255',
            'encargado' => 'max:255',
            'so' => 'max:255',
            'codigo_inventario' => 'max:255',
            'almacenamiento' => 'max:255',
        ], $message = [
            'required' => 'Este campo es obligatorio',
            'max' => 'Maximo de 255 caracteres'
        ]);

        try {
            $computador->marca = $req->marca;
            $computador->so = $req->so;
            $computador->fecha = $req->fecha;
            $computador->encargado = $req->encargado;
            $computador->modelo = $req->modelo;
            $computador->ram = $req->ram;
            $computador->almacenamiento = $req->almacenamiento;
            $computador->codigo_inventario = $req->codigo_inventario;

            $computador->save();
            if ($req->newOficina) {
                $of = new Oficina;
                $of->nombre = $req->newOficina;
                $of->save();
                $computador->oficinas()->detach();
                $computador->oficinas()->attach($of);
            }
            if ($req->newUso) {
                $newUso = new TipoUso;
                $newUso->nombre = $req->newUso;
                $newUso->save();
                $computador->tipo_usos()->detach();
                $computador->tipo_usos()->attach($newUso);
            }
            if ($req->oficinas) {
                $computador->oficinas()->detach();
                foreach ($req->oficinas as $oficina_id) {
                    $oficina = Oficina::find($oficina_id);

                    $computador->oficinas()->attach($oficina);
                }
            }
            if ($req->tipo_usos) {
                $computador->tipo_usos()->detach();
                foreach ($req->tipo_usos as $usos_id) {
                    # code...
                    $tipo_uso = TipoUso::find($usos_id);
                    $computador->tipo_usos()->attach($tipo_uso);
                }
            }
            if ($req->comentario) {

                $comentario = new Comentario;
                $comentario->computador()->associate($computador);
                $comentario->comentario = $req->comentario;
                $comentario->save();
            }


            return redirect(route('computador.show', $computador->id));
        } catch (Exception $e) {
            return view('error.show')->with('message', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Computador  $computador
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $computer = Computador::find($id);
        if ($computer == null) {
            abort(404);
        }
        return view('computador.show')->with('computer', $computer);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Computador  $computador
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $computador = Computador::find($id);
        if ($computador == null) {
            abort(404);
        }

        $oficinas = Oficina::all();
        $tipo_usos = TipoUso::all();
        $sos = DB::table('computadores')->select('so')->distinct()->get();


        return view('computador.edit')->with('computer', $computador)
            ->with('oficinas', $oficinas)
            ->with('tipo_usos', $tipo_usos)
            ->with('sos', $sos);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Computador  $computador
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $computador = Computador::find($id);
        if ($computador == null) {
            abort(404);
        }

        $req->validate([
            'modelo' => 'required|max:255',
            'fecha' => 'required|date',
            'marca' => 'required|max:255',
            'ram' => 'max:255',
            'encargado' => 'max:255',
            'so' => 'max:255',
            'codigo_inventario' => 'max:255',
            'almacenamiento' => 'max:255',
        ], $message = [
            'required' => 'Este campo es obligatorio',
            'max' => 'Maximo de 255 caracteres'
        ]);

        try {


            $computador->marca = $req->marca;
            $computador->so = $req->so;
            $computador->fecha = $req->fecha;
            $computador->encargado = $req->encargado;
            $computador->modelo = $req->modelo;
            $computador->ram = $req->ram;
            $computador->codigo_inventario = $req->codigo_inventario;

            $computador->save();

            if ($req->newOficina) {
                $of = new Oficina;
                $of->nombre = $req->newOficina;
                $of->save();
                $computador->oficinas()->detach();
                $computador->oficinas()->attach($of);
            }
            if ($req->newUso) {
                $newUso = new TipoUso;
                $newUso->nombre = $req->newUso;
                $newUso->save();
                $computador->tipo_usos()->detach();
                $computador->tipo_usos()->attach($newUso);
            }
            if ($req->oficinas) {
                $computador->oficinas()->detach();
                foreach ($req->oficinas as $oficina_id) {
                    # code...
                    $oficina = Oficina::find($oficina_id);
                    
                    $computador->oficinas()->attach($oficina);
                }
            }


            if ($req->tipo_usos) {
                    $computador->tipo_usos()->detach();
                foreach ($req->tipo_usos as $usos_id) {
                
                    $tipo_uso = TipoUso::find($usos_id);
                    
                    $computador->tipo_usos()->attach($tipo_uso);
                }
            }
            return redirect(route('computador.show', $computador->id));
        } catch (Exception $e) {
            return view('error.show')->with('message', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Computador  $computador
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $computador = Computador::find($id);
        if ($computador == null) {
            abort(404);
        }

        $computador->estado = false;
        $computador->save();

        return redirect(route('index'));
    }

    public function imprimir($id)
    {
        $computer = Computador::find($id);
        return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('computador.print', compact('computer'))->stream('invoice.pdf');
    }
}
