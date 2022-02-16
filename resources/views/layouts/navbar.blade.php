<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
 
    <!-- Mis estilos -->
    <link rel="stylesheet" href="{{asset('css/estilos.css')}}">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.5.0.js"></script>

    <title>Computadores</title>
</head>
<header>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
 
            <!--Izaquierda-->
            <ul class="navbar-nav me-auto">
                <li> <a class="navbar-brand" href="{{route('index')}}">Inicio</a></li>
            </ul>


            <!--Derecha-->
            <ul class="navbar-nav ms-auto">
                
                @guest
                    



                @else
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a href="{{route('user.profile')}}" class="dropdown-item">Perfil</a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li> <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a></li>
                        
                    </ul>
                    </li>
                @endguest
              </ul>



              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            
        </div>
    </nav>
</header>

<body>

    
       
    

    <div class="container-fluid">
        @yield('public')
        @auth
            @yield('user')
            @hasrole('admin')
            @yield('admin')
            @endhasrole
        @endauth
        
        
            
        
        
    </div>




    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

</body>

</html>
