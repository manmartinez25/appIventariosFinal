<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión Productos</title>
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
    <h1 class="text-center p-3">Página de productos</h1>

    @if (@session('correcto'))
        <div class="alert alert-success">{{session("correcto")}}</div>
    @endif

    @if (@session('incorrecto'))
        <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <script>
      var res = function(){
        var not =confirm("Estas seguro de eliminar");
        return not;
      }
    </script>

    <!-- Modal registro de producto-->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir producto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{route("product.createProd")}}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="txtnombreProducto" class="form-label">Nombre Producto</label>
                <input type="text" class="form-control" id="txtnombreProducto"
                  aria-describedby="emailHelp" name="txtnombreProducto">
              </div>
              <div class="mb-3">
                <label for="txttipoProducto" class="form-label">Tipo</label>
                <input type="text" class="form-control" id="txttipoProducto"
                  aria-describedby="emailHelp" name="txttipoProducto">
              </div>
              <div class="mb-3">
                <label for="txtdescripciónProd" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="txtdescripciónProd" 
                  aria-describedby="emailHelp" name="txtdescripciónProd">
              </div>
              <div class="mb-3">
                <label for="txtprecioProd" class="form-label">Precio</label>
                <input type="num" class="form-control" id="txtprecioProd"
                  aria-describedby="emailHelp" name="txtprecioProd">
              </div>
              <div class="mb-3">
                <label for="txtstockProd" class="form-label">Stock</label>
                <input type="num" class="form-control" id="txtstockProd"
                  aria-describedby="emailHelp" name="txtstockProd">
              </div>
              <div class="mb-3">
                <label for="txtmarcaProd" class="form-label">Marca</label>
                <input type="text" class="form-control" id="txtmarcaProd"
                  aria-describedby="emailHelp" name="txtmarcaProd">
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Añadir</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="p-5 table-responsive">
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Añadir Producto</button>

        <table class="table table-striped table-bordered table-hover">
            <thead class="table-dark thead-">
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nombre Producto</th>
                <th scope="col">Tipo</th>
                <th scope="col">Descripción</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
                <th scope="col">Marca</th>
                <th></th>
            </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach($datosProduc as $item)
                <tr>
                    <th scope="row">{{$item->id}}</th>
                    <td>{{$item->nombre_prod}}</td>
                    <td>{{$item->tipo_prod}}</td>
                    <td>{{$item->descripcion}}</td>
                    <td><b>$</b>{{$item->precio}}</td>
                    <td>{{$item->stock}}</td>
                    <td>{{$item->marca}}</td>
                    <td>
                      <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{$item->id}}"><button type="button" class="btn btn-warning btn-sm">Editar</button></a>
                      <a href="{{route("product.deleteProd",$item->id)}}" onclick="return res()"><button type="button" class="btn btn-danger btn-sm">Borrar</button></a>
                    </td>

                      <!-- Modal modificar-->
                      <div class="modal fade" id="modalEditar{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar datos del producto</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <form action="{{route("product.updateProd")}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                  <label for="txtidProducto" class="form-label">Id Producto</label>
                                  <input type="text" class="form-control" id="txtidProducto"
                                    aria-describedby="emailHelp" name="txtidProducto" value="{{$item->id}}" readonly>
                                </div>
                                <div class="mb-3">
                                  <label for="txtnombreProducto" class="form-label">Nombre Producto</label>
                                  <input type="text" class="form-control" id="txtnombreProducto"
                                    aria-describedby="emailHelp" name="txtnombreProducto" value="{{$item->nombre_prod}}">
                                </div>
                                <div class="mb-3">
                                  <label for="txttipoProducto" class="form-label">Tipo</label>
                                  <input type="text" class="form-control" id="txttipoProducto"
                                    aria-describedby="emailHelp" name="txttipoProducto" value="{{$item->tipo_prod}}">
                                </div>
                                <div class="mb-3">
                                  <label for="txtdescripciónProd" class="form-label">Descripción</label>
                                  <input type="text" class="form-control" id="txtdescripciónProd" 
                                    aria-describedby="emailHelp" name="txtdescripciónProd" value="{{$item->descripcion}}">
                                </div>
                                <div class="mb-3">
                                  <label for="txtprecioProd" class="form-label">Precio</label>
                                  <input type="number" class="form-control" id="txtprecioProd"
                                    aria-describedby="emailHelp" name="txtprecioProd" value="{{$item->precio}}">
                                </div>
                                <div class="mb-3">
                                  <label for="txtstockProd" class="form-label">Stock</label>
                                  <input type="number" class="form-control" id="txtstockProd"
                                    aria-describedby="emailHelp" name="txtstockProd" value="{{$item->stock}}">
                                </div>
                                <div class="mb-3">
                                  <label for="txtmarcaProd" class="form-label">Marca</label>
                                  <input type="text" class="form-control" id="txtmarcaProd"
                                    aria-describedby="emailHelp" name="txtmarcaProd" value="{{$item->marca}}">
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                  <button type="submit" class="btn btn-primary">Modificar</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                  </tr>
                @endforeach
            
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
</body>
</html>