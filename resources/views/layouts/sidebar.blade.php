<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.0.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.0.js"> </script>
    <script src="{{ asset('js/myjs.js') }}"></script>
</head>

<body>

    <div class="container-fluid">

        <div class="row flex-nowrap">
            <div class="col-auto  px-sm-2 px-0 bg-dark">
                <div class="d-flex flex-column align-items-center align-items-sm-start px-3   min-vh-100">

                    <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-center navigation"
                        id="menu">

                        {{-- HOME --}}
                        <li class="nav-item ">
                            <a href="{{ route('index') }}" class="nav-link align-middle px-0">
                                <i class="bi bi-house" style="font-size: 2rem;"></i>
                            </a>
                        </li>
                        <hr>

                             {{-- Perfil --}}
                             <li class="nav-item">
                                <a href="{{ route('user.profile') }}"
                                    class="nav-link align-middle px-0">
                                    <i class="bi bi-person-circle" style="font-size: 2rem;"></i>
                                </a>
                            </li>
                        @role('admin')
                            {{-- Ususarios --}}
                            <li class="nav-item ">
                                <a href="{{ route('admin.show.all') }}" class="nav-link align-middle px-0">
                                    <i class="bi bi-people-fill" style="font-size: 2rem;"></i>
                                </a>
                            </li>
                            {{-- Crear Ususario --}}
                            <li class="nav-item ">
                                <a href="{{ route('user.create') }}" class="nav-link align-middle px-0">
                                    <i class="bi bi-person-plus-fill" style="font-size: 2rem;"></i>
                                </a>
                            </li>
                        @endrole
                       
                        {{-- Settings --}}

                        {{-- <li class="nav-item">
                            <a href="{{ route('settings-user',auth()->user()->id) }}" class="nav-link align-middle px-0">
                                <i class="bi bi-gear-fill" style="font-size: 2rem;"></i>
                            </a>
                        </li> --}}




                    </ul>
                    <hr>
                    {{-- Logout --}}
                    <div class=" pb-4">
                        @guest

                        @else
                            <a class="d-flex align-items-center  text-decoration-none nav-item "
                                href="{{ route('logout') }}" onclick="logout()">
                                <i class="bi bi-box-arrow-left" style="font-size: 2rem;"></i>



                            </a>
                        @endguest


                    </div>
                </div>
            </div>
            <form id="logout-form"  action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            <div class="col py-3">
                <!--Content area...-->
                <div class="continer-fluid">

                    @yield('user')

                    @hasrole('admin')
                        @yield('admin')
                    @endhasrole
                </div>


            </div>
        </div>
    </div>




    <script>
        function logout() {

            event.preventDefault();
            if (!confirm("¿Seguro que deseas Salir?")) {
                return false;
            }
            document.getElementById('logout-form').submit();
        }
    </script>

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
</body>

</html>
