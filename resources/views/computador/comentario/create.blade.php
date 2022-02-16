@extends('layouts.navbar')

@section('user')
    <link rel="stylesheet" type="text/css" href="{{asset('css/comentarios.css')}}">


    <div class="container-sm mt-5">
        <div class="row" style="padding-bottom: 20px">
            <form action="{{route('comentario.store',$compu_id)}}" class="needs-validation" method="POST">
               @csrf

                <div class="mb-3">
                    <label for="encargado" class="form-label">Comentario nuevo</label>
                    <textarea maxlength="255" class="form-control" name="comentario" id="comentario" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-dark">Agregar</button>
               <a class="btn btn-light" href="{{route('computador.show',$compu_id)}}">Volver</a>
            </form>
        </div>

        <h6>Comentarios</h6>
        @foreach ($comentarios as $comentario)
            <div class="row">
                <div class="commentbox ">
                   <div class="col">
                    {{ $comentario->comentario }}
                  </div>
                    <a href="{{route('comentario.edit',$comentario->id)}}" class="btn btn-dark col-1"><i class="bi bi-pencil-square"></i></a>
                </div>
                
            </div>


        @endforeach
    </div>

    <script>

    </script>

@endsection
