@extends('layouts.sidebar')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

@section('settings')

    <div class="container">

        <div class="container">
            <div class="card table-container">

                <div class="card-body">
                    <div class="card-text overflow-scroll" style="height:  450px;">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>

                                </tr>
                            </thead>
                            <div>
                                <tbody>
                                    @if (auth()->user()->hasRole('admin') && $users)
                                        <form id="roleForm" action="{{ route('set-roles') }}" method="post">
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td scope="row">{{ $user->name }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>


                                                        @foreach ($roles as $rol)

                                                            @csrf
                                                            <div class="form-check">
                                                                <input class="form-check-input ck"
                                                                    name="roles[{{ $user->email }}][]" type="checkbox"
                                                                    value="{{ $rol->name }}" id="{{ $rol->name . $i }}"
                                                                    @if ($user->hasRole($rol->name)) checked  @endif>

                                                                <label class="form-check-label"
                                                                    for="{{ $rol->name . $i }}">
                                                                    {{ $rol->name }}
                                                                </label>
                                                            </div>

                                                        @endforeach



                                                    </td>
                                                </tr>
                                                @php
                                                    $i++;
                                                @endphp

                                            @endforeach
                                        </form>
                                    @endif

                                </tbody>
                            </div>

                        </table>
                    </div>

                </div>
                <div class="card-footer">


                    <div class="row justify-content-between">
                        <div class="col text-start">
                            <button id="guardar" form="roleForm" type="submit" class="btn btn-primary">Guardar</button>

                        </div>
                        <div class="col-2">

                            <input type="checkbox" class="form-check-input" id="selectAll">
                            <label class="form-check-label" for="selectAll"> Seleccionar Todos </label>

                        </div>


                    </div>



                </div>
            </div>
        </div>

    </div>
    <script>
        $(document).ready(function() {
            $("div input#selectAll").click(function(e) {
                if ($(this).is(":checked")) {
                    $(".ck:checkbox:not(:checked)").attr("checked", "checked");
                } else {
                    $(".ck:checkbox:checked").removeAttr("checked");
                }

            });

        });
    </script>
@endsection
