<div class="container">
    {{-- <img class="logo-muni" src="https://ligup-v2.s3-sa-east-1.amazonaws.com/quintero/media/quinterologo-01.png" alt=""> --}}
     {{-- <img class="logo-muni" src=" {{public_path('img/quinterologo.png')}}" alt="">
    <div>
        {{ URL::to('/') }}/img/quinterologo.png
    </div>
    <div>
        {{url('/img/quinterologo.png')}}
    </div>
    <div>
        {{public_path('img/quinterologo.png')}}
    </div>
     --}}
    
    <h1>{{ $computer->marca.' '. $computer->modelo }}</h1>
    <table class="table">
        <tr>
            <th>Marca</th>
            <td>{{ $computer->marca }}</td>
        </tr>
        <tr>
            <th>Modelo</th>
            <td>{{ $computer->modelo }}</td>
        </tr>
        <tr>
            <th>Encargado</th>
            @if ($computer->encargado)
                <td>{{ $computer->encargado }}</td>

            @else
                <td></td>

            @endif


        </tr>

        <tr>
            <th>Oficinas</th>

            @if ($computer->oficinas)
                <td>
                    @foreach ($computer->oficinas as $oficina)
                        {{ $oficina->nombre }} |
                    @endforeach
                </td>
            @else
                <td>Null</td>
            @endif
        </tr>

        <tr>
            <th>Tipos de Uso</th>
            @if ($computer->tipo_usos)
                <td>
                    @foreach ($computer->tipo_usos as $usos)
                        {{ $usos->nombre }} |
                    @endforeach
                </td>

            @else
                <td>Empty</td>

            @endif
        </tr>
        <tr>
            <th>Sistema Operativo</th>
            <td>{{ $computer->so }}</td>
        </tr>

        <tr>
            <th>Almacenamiento</th>
            <td>

                {{ $computer->almacenamiento }}
            </td>
        </tr>

        <tr>
            <th>RAM</th>
            <td>{{ $computer->ram }}</td>
        </tr>
        <tr>
            <th>SO KEY</th>
            <td>{{ $computer->so_key }}</td>
        </tr>
        <tr>
            <th>Microsoft Office Key</th>
            <td>{{ $computer->office_key }}</td>
        </tr>
        <tr>
            <th>Fecha</th>
            <td>{{ date('d-m-Y', strtotime($computer->fecha)) }}</td>

        </tr>
        <tr>
            <th>Codigo de Inventario</th>
            <td>{{ $computer->codigo_inventario }}</td>
        </tr>

    </table>
</div>
<div>
   <h5>Comentarios</h5>
    @foreach ($computer->comentarios as $comentario)
        <div class="commentbox">
            {{ $comentario->comentario }}
        </div>
    @endforeach

</div>

<style>

    .container {
        text-align: center;
    }

    table {
        margin-left: auto;
        margin-right: auto;
        padding: 0.5rem;
    }

    th {
        border-width: 0;
        text-align: start;
        border-bottom: solid 1px;

    }

    td {
        border-width: 0;
        margin-left: 0;
        text-align: end;
        padding-left: 20%;
        border-bottom: solid 1px;

    }

    tbody,
    td,
    tfoot,
    th,
    thead,
    tr {
        border-color: inherit;
        border-style: solid;
        border-width: 0;
        border-bottom-width: 0px;
    }

    table {
        padding: .5rem .5rem;

        border-bottom-width: 1px;
        box-shadow: inset 0 0 0 9999px var(--bs-table-accent-bg);
    }

    .commentbox {
        border: black solid 1px;
        opacity: 1;
        border-radius: 5px;
        padding: 1%;
        margin-top: 0.5%;

    }
    img{
        width: 200px;
    }

</style>
