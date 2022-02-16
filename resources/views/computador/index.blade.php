@extends('layouts.navbar')

@section('table')

<div class="row align-items-center">
    <div class="col">
        <a href="{{ route('computador.create') }}" class="btn btn-dark">Agregar</a>
        {{--<a href="{{route('forgeOfGods',auth()->user()->id)}}">aaaa</a>--}}

        
    </div>
    <div class="col">
        @include('computador.search-bar')
    </div>
</div>


    
    <table class="table ">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
             
                <th>Oficina</th>

                <th>Usuario</th>
                <th>Tipos de Uso</th>
                <th>acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($computers as $computer)
                <tr>
                    <td>{{$computer->id}}</td>
                    <td>{{$computer->marca}}</td>
                    <td>{{$computer->modelo}}</td>
                    @if ($computer->oficinas->first() == null)
                        <td>No tiene oficina asignada</td>

                    @else
 
                        <td>
                        @foreach ($computer->oficinas as $oficina)
                            {{$oficina->nombre}};                           
                        @endforeach
                        </td>

                    @endif  
                    @if ($computer->encargado !=null)
                        <td>{{$computer->encargado}}</td>  
                    @else
                        <td>No tiene encargado</td>
                    @endif
                     
                    
                    @if ($computer->tipo_usos->first() == null)

                        <td>No tiene tipo de uso asignado</td>
                    @else
                        <td>
                        @foreach ($computer->tipo_usos as $tipo_uso)
                            {{$tipo_uso->nombre}};                           
                        @endforeach
                        </td>
                    @endif
                    

 
            <th>
                
                <a href="{{route('show',$computer->id)}}" class= "btn btn-outline-dark">Ver</a>
            
            </th>


            @endforeach
            
            
        </tbody>
    </table>
    <div class="row">
        {{$computers->links()}}
    </div>
    

@endsection