<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ingreso de Productos</title>
    <link rel="stylesheet" href="{!! asset('css/styleProducts.css') !!}">        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<header>
    <div class="containerHeader" data-bs-theme="dark">
        <nav class="navbar navbar-expand-lg bg-body-tertiary" style="padding:1.5rem">
          <div class="container-fluid">
            <a class="navbar-brand" href="{{route('home.home')}}">App Inventarios</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                <a class="nav-link active" aria-current="page" href="{{ route('home.home') }}">Home</a>
                <a class="nav-link" href="{{ route('product.gestProducts') }}">Productos</a>
                <a class="nav-link" href="{{ route('ingresos.ingresoProducts') }}">Ingresos</a>
                <a class="nav-link" href="{{ route('ventas.gestVentas') }}">Ventas</a>
                <a class="nav-link" href="{{ route('inventario.gestInventario') }}">Inventarios</a>
              </div>
              <div class="d-flex ms-auto">
                <form action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="btn btn-outline-primary me-2">Salir</button>
                </form>
              </div>
            </div>
          </div>
        </nav>
      </div>
</header>
<body>
    <img class="wave" src="img/wave.png" alt="imagenFondo">
    <h1 class="text-center p-3">Ingreso de Productos</h1>

    @if (@session('correcto'))
    <div class="alert alert-success">{{session("correcto")}}</div>
    @endif

    @if (@session('incorrecto'))
        <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <!-- Modal registro de ingresos-->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir registros de ingresos</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{route("ingresos.createIngr")}}" method="POST">
              @csrf
              
              <div class="mb-3">
                <label for="txtLoteIngreso" class="form-label">Lote</label>
                <input type="number" class="form-control" id="txtLoteIngreso"
                  aria-describedby="emailHelp" name="txtLoteIngreso" value="">
              </div>
              <div class="mb-3">
                <label for="txtFecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="txtFecha"
                  aria-describedby="emailHelp" name="txtFecha" value="">
              </div>
              
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Opciones Id</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="txtIdProd">
                  <option selected>Id Productos</option>
                    @foreach($datosProd as $producto)
                     <option type="number" value="{{$producto->id}}" data-tipo-prod="{{$producto->tipo_prod }}">{{$producto->nombre_prod}}</option>
                    @endforeach
                </select>
              </div>

              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  var selectElement = document.getElementById('inputGroupSelect01');
                  var tipoProdInput = document.getElementById('txtTipoProd');

                  selectElement.addEventListener('change', function() {
                      var selectedOption = this.options[this.selectedIndex];
                      var tipoProd = selectedOption.getAttribute('data-tipo-prod');
                      tipoProdInput.value = tipoProd || ''; // Asigna el tipo de producto al campo de entrada
                  });
              });
              </script>

              <div class="mb-3">
                <label for="txtTipoProd" class="form-label">Tipo Producto</label>
                <input type="text" class="form-control" id="txtTipoProd"
                aria-describedby="emailHelp" name="txtTipoProd" value="" readonly>
              </div>

              <div class="mb-3">
                <label for="txtCantidad" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="txtCantidad"
                  aria-describedby="emailHelp" name="txtCantidad" value="">
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
      <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Añadir registro</button>
      <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark thead- text-white">
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Lote</th>
            <th scope="col">Fecha</th>
            <th scope="col">Tipo Producto</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Id Producto</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @foreach($datosIngresos as $item)
          <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->num_lote}}</td>
            <td>{{$item->fecha}}</td>
            <td>{{$item->tipo_prod}}</td>
            <td>{{$item->cantidad}}</td>
            <td>{{$item->id_producto}}</td>
            <td>
              <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{$item->id}}"><button type="button" class="btn btn-warning btn-sm">Editar</button></a>
            </td>
              <!-- Modal modificar ingresos-->
              <div class="modal fade" id="modalEditar{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar registros de ingresos</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{route("ingresos.updateIngr")}}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="txtidIngreso" class="form-label">Id Ingreso</label>
                          <input type="text" class="form-control" id="txtidIngreso"
                            aria-describedby="emailHelp" name="txtidIngreso" value="{{$item->id}}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="txtLoteIngreso" class="form-label">Lote</label>
                          <input type="number" class="form-control" id="txtLoteIngreso"
                            aria-describedby="emailHelp" name="txtLoteIngreso" value="{{$item->num_lote}}">
                        </div>
                        <div class="mb-3">
                          <label for="txtFecha" class="form-label">Fecha</label>
                          <input type="date" class="form-control" id="txtFecha"
                            aria-describedby="emailHelp" name="txtFecha" value="{{$item->fecha}}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="txtTipoProd" class="form-label">Tipo Producto</label>
                          <input type="text" class="form-control" id="txtTipoProd"
                            aria-describedby="emailHelp" name="txtTipoProd" value="{{$item->tipo_prod}}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="txtCantidad" class="form-label">Cantidad</label>
                          <input type="number" class="form-control" id="txtCantidad"
                            aria-describedby="emailHelp" name="txtCantidad" value="{{$item->cantidad}}">
                        </div>
                        <div class="mb-3">
                          <label for="txtCantidad" class="form-label">Id Producto</label>
                            <input type="text" class="form-control" id="txtIdProduct"
                            aria-describedby="emailHelp" name="txtIdProduct" value="{{$item->id_producto}}" readonly>
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