<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clientes</title>
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
    <h1 class="text-center p-3">Clientes</h1>

    <div class="p-5 table-responsive">
      <div class="dropdown">
        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
          Tipo de visualización
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <li><a class="dropdown-item" href="{{route('inventario.gestInventario')}}">Productos</a></li>
          <li><a class="dropdown-item" href="{{route('inventarioIng.gestInvIngreso')}}">Historial Ingresos</a></li>
          <li><a class="dropdown-item" href="{{route('inventarioIng.gestInvVenta')}}">Historial Ventas</a></li>
        </ul>
      </div>
        
    
        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark thead-">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Identificación</th>
                  <th scope="col">Correo</th>
                  <th scope="col">Teléfono</th>
                  <th scope="col">Dirección</th>
                  <th scope="col">Tipo Cliente</th>
                  <th scope="col">Id Compras</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($datosClientes as $item)
                <tr>
                  <th scope="row">{{$item->id_Tercero}}</th>
                  <td>{{$item->nombre}}</td>
                  <td>{{$item->identificacion}}</td>
                  <td>{{$item->correo}}</td>
                  <td>{{$item->telefono}}</td>
                  <td>{{$item->direccion}}</td>
                  <td>{{$item->tipoTercero}}</td>
                  <td>{{$item->id_ventas}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    

</body>
</html>