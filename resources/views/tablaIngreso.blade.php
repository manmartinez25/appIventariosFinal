<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Historial Ingresos</title>
    <link rel="stylesheet" href="{!! asset('css/styleProducts.css') !!}">        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    

</head>
<header>
    <div class="containerHeader" data-bs-theme="dark">
        <nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding:1.5rem">
          <div class="container-fluid">
            <a class="navbar-brand" href="{{ route('home.home')}}">App Inventarios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href={{ route('home.home')}}>Home</a>
                <a class="nav-link" href="#">Productos</a>
                <a class="nav-link" href="#">Ingresos</a>
                <a class="nav-link" href="#">Ventas</a>
                <a class="nav-link" href="#">Inventarios</a>
                <a class="nav-link" href="#">Cerrar Sesión</a>
              </div>
            </div>
          </div>
        </nav>
      </div>
</header>
<body>
    <img class="wave" src="img/wave.png" alt="imagenFondo">
    <h1 class="text-center p-3">Historial de Ingresos</h1>

    @if (@session('correcto'))
        <div class="alert alert-success">{{session("correcto")}}</div>
    @endif

    @if (@session('incorrecto'))
        <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <!-- Modal registro de ingresos-->
    <div class="modal fade" id="modalFiltroFecha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir flitro de fecha</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route("filtroFecha.filtrarFecha")}}" method="POST">
                @csrf
                
                <div class="mb-3">
                    <label for="txtFechaInicial" class="form-label">Fecha Inicial</label>
                    <input type="date" class="form-control" id="txtFechaInicial"
                    aria-describedby="emailHelp" name="txtFechaInicial" value="">
                </div>
                <div class="mb-3">
                    <label for="txtFechaFinal" class="form-label">Fecha Final</label>
                    <input type="date" class="form-control" id="txtFechaFinal"
                    aria-describedby="emailHelp" name="txtFechaFinal" value="">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    
    <div class="p-5" table-responsive>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              Tipo de visualización
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="{{route('inventario.gestInventario')}}">Productos</a></li>
                <li><a class="dropdown-item" href="{{route('inventarioIng.gestInvVenta')}}">Historial Ventas</a></li>
                <li><a class="dropdown-item" href="{{route('inventarioIng.gestInvClientes')}}">Clientes</a></li>
            </ul>
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalFiltroFecha">Añadir Filtro</button>
          </div>
      <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark thead- text-white">
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Lote</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Tipo Producto</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Id Producto</th>
                </tr>

            </thead>
            <tbody class="table-group-divider">
                @foreach($datosIngresos as $item)
                <tr>
                    <<th scope="row">{{$item->id}}</th>
                    <td>{{$item->num_lote}}</td>
                    <td>{{$item->fecha}}</td>
                    <td>{{$item->tipo_prod}}</td>
                    <td>{{$item->cantidad}}</td>
                    <td>{{$item->id_Producto}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    

    </body>
</html>