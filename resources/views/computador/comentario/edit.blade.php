@extends('layouts.navbar')

@section('user')
    
    <!-- Comentario para Editar -->
    <div class="container-sm">
        <div class="row" style="padding-bottom: 20px">
            <form action="{{ route('comentario.update', $comentario->id) }}" class="needs-validation" method="POST" action="">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="encargado" class="form-label">Comentario nuevo</label>
                    <textarea val class="form-control" name="comentario" id="comentario"
                        rows="3" required>{{ $comentario->comentario }}</textarea>

                </div>
                <button type="submit" href="" class="btn btn-dark">Agregar</button>
                <a class="btn btn-light" href="{{ route('computador.show', $comentario->computador->id) }}">Volver</a>




            </form>
        </div>
        <!-- Demas Comentarios -->
        <h6>Comentarios</h6>
        @foreach ($computador->comentarios as $comment)
            @if ($comment->id != $comentario->id)
                <div class="row">
                    <div class="commentbox ">
                        <div class="col">
                            {{ $comment->comentario }}
                        </div>
                        <a href="{{ route('comentario.edit', $comment->id) }}" class="btn btn-dark col-1"><i
                                class="bi bi-pencil-square"></i></a>
                    </div>

                </div>

            @endif



        @endforeach
    </div>

    <script>

    </script>

@endsection
