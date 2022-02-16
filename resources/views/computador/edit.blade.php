@extends('layouts.navbar')

@section('user')
    <?php
    $i = 0;
    $ar = null;
    $ar2 = null;
    foreach ($computer->oficinas as $oficina) {
        $ar[$i] = $oficina->id;
        $i++;
    }
    $i = 0;
    
    foreach ($computer->tipo_usos as $uso) {
        $ar2[$i] = $uso->id;
        $i++;
    }
    
    ?>
    <div class="container-sm">

        <form action="{{route('computador.update',$computer->id)}}" method="post">
            @csrf
            @method('PUT')

            <div class="row">


                <div class="mb-3 col-6">
                    <label for="marca" class="form-label">Marca</label>
                    <input required type="text" class="form-control" name="marca" id="marca" placeholder="Marca"
                        value="{{ $computer->marca }}">
                    <small id="helpId" class="form-text text-muted">Marca del Fabricante</small>
                </div>

                <div class="mb-3 col-6">
                    <label for="modelo" class="form-label">Modelo</label>
                    <input required type="text" class="form-control" name="modelo" id="modelo" placeholder="Modelo"
                        value="{{ $computer->modelo }}">
                    <small id="helpId" class="form-text text-muted">Modelo del Computador</small>
                </div>


                <div class="mb-3 col-6">
                    <label for="so" class="form-label">Sistema Operativo</label>
                    <input required type="text" list="soList" class="form-control" name="so" id="so"
                        placeholder="Sistema Operativo" value="{{ $computer->so }}">
                    <small id="helpId" class="form-text text-muted">Ejemplo: " Windows 10 "</small>

                    @isset($sos)
                        <datalist id="soList">
                            @foreach ($sos as $so)
                                <option value="{{ $so->so }}"></option>
                            @endforeach
                        </datalist>
                    @endisset

                </div>
                <div class="mb-3 col-6">
                    <label for="ram" class="form-label">RAM</label>
                    <input required type="text" class="form-control" name="ram" id="ram" placeholder="RAM"
                        value="{{ $computer->ram }}">
                    <small class="form-text text-muted">Ejemplo: " 4 GB "</small>
                </div>
                <div class="mb-3 col-6">
                    <label for="almacenamiento" class="form-label">Almacenamiento</label>


                    <input required type="text" class="form-control" name="encargado" id="Almacenamiento"
                        placeholder="Almacenamiento" value="{{ $computer->almacenamiento }}">
                    <small id="helpId" class="form-text text-muted">Ejemplo: " 500 GB "</small>

                </div>

                <div class="mb-3 col-6">
                    <label for="encargado" class="form-label">Encargado</label>
                    <input type="text" class="form-control" name="encargado" id="encargado" placeholder="Encargado"
                        @if ($computer->encargado)
                    value="{{ $computer->encargado }}"
                    @endif
                    >
                    <small id="helpId" class="form-text text-muted">Persona a cargo del Computador</small>
                </div>

                <div class="mb-3 col-6">
                    <label for="so_key" class="form-label">Key del Sitema Operativo</label>
                    <input type="text" class="form-control" name="so_key" id="so_key" placeholder=""
                        value="{{ $computer->so_key }}">
                    <small class="form-text text-muted">opcional</small>
                </div>

                <div class="mb-3 col-6">
                    <label for="office_key" class="form-label">Key de Microsoft Office</label>
                    <input type="text" class="form-control" name="office_key" id="office_key" placeholder=""
                        value="{{ $computer->office_key }}">
                    <small class="form-text text-muted">opcional</small>
                </div>

                <div class="mb-3 col-6">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input required type="date" class="form-control" name="fecha" id="fecha" placeholder="Fecha"
                        value="{{ $computer->fecha }}">
                    <small id="helpId" class="form-text text-muted"></small>
                </div>


                <div class="mb-3 col-6">
                    <label for="codigo_inventario" class="form-label">Codigo de Inventario</label>
                    <input type="text" class="form-control" name="codigo_inventario" id="codigo_inventario" placeholder=""
                        value="{{ $computer->codigo_inventario }}">
                    <small class="form-text text-muted">opcional</small>
                </div>


            </div>


            <div class="row">




                <div class="mb-3 col">

                    <h6>Elija a que oficina(s) pertenece el Computador</h6>
                    @isset($oficinas)
                        @foreach ($oficinas as $oficina)

                            <div class="form-check">

                                <input class="form-check-input" type="checkbox" name="oficinas[]"
                                    id="oficina{{ $oficina->id }}" value="{{ $oficina->id }}" @if ($ar)
                                @if (in_array($oficina->id, $ar))
                                    checked
                                @endif
                        @endif
                        >
                        <label class="form-check-label" for="oficina{{ $oficina->id }}">
                            {{ $oficina->nombre }}
                        </label>
                    </div>

                    @endforeach

                @endisset
                <div class="input-group">
                    <label for="otraOficina" class="form-check-label input-group-text"> Otra </label>
                    <div class="input-group-text">

                        <input class="form-check-input mt-0" type="checkbox" id="otraOficina"
                            aria-label="Checkbox for following text input">
                    </div>
                    <input type="text" class="form-control" name="newOficina" id="nuevaOficina" disabled>

                </div>


            </div>



            <div class="mb-3 col">
                <h6>Elija que Uso(s) tiene, tuvo o tendra</h6>
                @isset($tipo_usos)
                    @foreach ($tipo_usos as $uso)

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="tipo_usos[]" id="uso{{ $uso->id }}"
                                value="{{ $uso->id }}" @if ($ar2)
                            @if (in_array($uso->id, $ar2))
                                checked
                            @endif
                    @endif


                    >
                    <label class="form-check-label" for="uso{{ $uso->id }}">
                        {{ $uso->nombre }}
                    </label>
                </div>

                @endforeach
            @endisset
            <div class="input-group">
                <label for="otroUso" class="form-check-label input-group-text"> Otro </label>
                <div class="input-group-text">

                    <input class="form-check-input mt-0" type="checkbox" id="otroUso">
                </div>
                <input type="text" class="form-control" name="newUso" id="nuevoUso" disabled>

            </div>
    </div>







    <div>
        <button type="submit" class="btn btn-dark">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
        <a href="{{ route('index') }}" class="btn btn-danger">Cancel</a>

    </div>

    </form>


    </div>

    <script src="{{ asset('js/checkboxes.js') }}"></script>
@endsection
