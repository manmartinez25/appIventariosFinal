<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gestión Ventas</title>
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
    <h1 class="text-center p-3">Ingreso de registros de ventas</h1>

    @if (@session('correcto'))
    <div class="alert alert-success">{{session("correcto")}}</div>
    @endif

    @if (@session('incorrecto'))
        <div class="alert alert-danger">{{session("incorrecto")}}</div>
    @endif

    <!-- Modal registro de ventas-->
    <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir registros de ventas</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{route("ventas.createVenta")}}" method="POST">
              @csrf
              
              <div class="mb-3">
                <label for="txtFechaVenta" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="txtFechaVenta"
                  aria-describedby="emailHelp" name="txtFechaVenta" value="">
              </div>

              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Opciones Productos</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="txtIdProductoVenta">
                  <option selected>Productos</option>
                    @foreach($datosProd as $id_Producto)
                     <option type="number" value="{{$id_Producto->id}}" data-nombre-prod="{{$id_Producto->nombre_prod }}" data-marca-prod="{{$id_Producto->marca}}" data-precio-prod="{{$id_Producto->precio}}">{{$id_Producto->nombre_prod}}</option>
                    @endforeach
                </select>
              </div>

              <script>
                document.addEventListener('DOMContentLoaded', function() {
                  var selectElement = document.getElementById('inputGroupSelect01');
                  var cantidadElement = document.getElementById('txtCantidadVenta');
                  var nombreProdInput = document.getElementById('txtNomProdVenta');
                  var marcaInput = document.getElementById('txtMarcaVenta');
                  var precioInput = document.getElementById('txtPrecioVenta');
                  var totalInput = document.getElementById('txtTotaldVenta');

                  selectElement.addEventListener('change', function() {
                      var selectedOption = this.options[this.selectedIndex];
                      var nombreProd = selectedOption.getAttribute('data-nombre-prod');
                      nombreProdInput.value = nombreProd || ''; // Asigna el nombre al campo de entrada

                      var marcaProd = selectedOption.getAttribute('data-marca-prod');
                      marcaInput.value = marcaProd || ''; // Asigna la marca al campo de entrada

                      var precioProd = selectedOption.getAttribute('data-precio-prod');
                      precioInput.value = precioProd || ''; // Asigna el precio al campo de entrada
                  });

                  cantidadElement.addEventListener('change', function() {
                      var selectedOption = selectElement.options[selectElement.selectedIndex];
                      var precioProd = parseFloat(selectedOption.getAttribute('data-precio-prod'));
                      var cantidad = parseFloat(this.value); // Obtener el valor de la cantidad

                      actualizarTotal(precioProd, cantidad);
                  });

                  function actualizarTotal(precioProd, cantidad) {
                      precioProd = parseFloat(precioProd);
                      cantidad = parseFloat(cantidad);

                      if (!isNaN(precioProd) && !isNaN(cantidad)) {
                          var totalVenta = precioProd * cantidad;
                          totalInput.value = totalVenta.toFixed(2); 
                      } else {
                          totalInput.value = '';
                      }
                  }
              });
              </script>

              <div class="mb-3">
                <label for="txtNomProdVenta" class="form-label">Nombre Producto</label>
                <input type="text" class="form-control" id="txtNomProdVenta"
                  aria-describedby="emailHelp" name="txtNomProdVenta" value="">
              </div>
              <div class="mb-3">
                <label for="txtMarcaVenta" class="form-label">Marca</label>
                <input type="text" class="form-control" id="txtMarcaVenta"
                  aria-describedby="emailHelp" name="txtMarcaVenta" value="">
              </div>
              <div class="mb-3">
                <label for="txtPrecioVenta" class="form-label">Precio</label>
                <input type="number" class="form-control" id="txtPrecioVenta"
                  aria-describedby="emailHelp" name="txtPrecioVenta" value="">
              </div>
              <div class="mb-3">
                <label for="txtCantidadVenta" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="txtCantidadVenta"
                  aria-describedby="emailHelp" name="txtCantidadVenta" value="">
              </div>
              <div class="mb-3">
                <label for="txtTotaldVenta" class="form-label">Total</label>
                <input type="number" class="form-control" id="txtTotaldVenta"
                  aria-describedby="emailHelp" name="txtTotaldVenta" value="" readonly>
              </div>
              
              <div class="mb-3">
                <label for="txtNombreVenta" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="txtNombreVenta"
                  aria-describedby="emailHelp" name="txtNombreVenta" value="">
              </div>
              <div class="mb-3">
                <label for="txtIdentificacionVenta" class="form-label">Indentificación</label>
                <input type="number" class="form-control" id="txtIdentificacionVenta"
                  aria-describedby="emailHelp" name="txtIdentificacionVenta" value="">
              </div>
              <div class="mb-3">
                <label for="txtCorreoVenta" class="form-label">Correo</label>
                <input type="email" class="form-control" id="txtCorreoVenta"
                  aria-describedby="emailHelp" name="txtCorreoVenta" value="">
              </div>
              <div class="mb-3">
                <label for="txtTelefonoVenta" class="form-label">Teléfono</label>
                <input type="number" class="form-control" id="txtTelefonoVenta"
                  aria-describedby="emailHelp" name="txtTelefonoVenta" value="">
              </div>
              <div class="mb-3">
                <label for="txtDireccionVenta" class="form-label">Dirección</label>
                <input type="text" class="form-control" id="txtDireccionVenta"
                  aria-describedby="emailHelp" name="txtDireccionVenta" value="">
              </div>
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <label class="input-group-text" for="inputGroupSelect01">Tipo Cliente</label>
                </div>
                <select class="custom-select" id="inputGroupSelect01" name="txtTipoVenta">
                  <option selected>Opciones</option>
                  <option value="Natural">Natural</option>
                  <option value="Juridico">Juridico</option>
                </select>
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
            <th scope="col">Fecha</th>
            <th scope="col">Nombre Producto</th>
            <th scope="col">Marca</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Total</th>
            <th scope="col">Nombre</th>
            <th scope="col">Indentificación</th>
            <th scope="col">Correo</th>
            <th scope="col">Teléfono</th>
            <th scope="col">Dirección</th>
            <th scope="col">Tipo</th>
            <th scope="col">Id Producto</th>
            <th></th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @foreach($datosVentas as $item)
          <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->fecha}}</td>
            <td>{{$item->nombre_prod}}</td>
            <td>{{$item->marca}}</td>
            <td>{{$item->precio}}</td>
            <td>{{$item->cantidad}}</td>
            <td>{{$item->total_venta}}</td>
            <td>{{$item->nombre_tercero}}</td>
            <td>{{$item->identificacion_tercero}}</td>
            <td>{{$item->correo}}</td>
            <td>{{$item->telefono}}</td>
            <td>{{$item->direccion}}</td>
            <td>{{$item->tipo_tercero}}</td>
            <td>{{$item->id_producto}}</td>
            <td>
              <a href="" data-bs-toggle="modal" data-bs-target="#modalCliente{{$item->id}}"><button type="button" class="btn btn-primary btn-sm">Cliente</button></a>
              <a href="" data-bs-toggle="modal" data-bs-target="#modalEditar{{$item->id}}"><button type="button" class="btn btn-warning btn-sm">Editar</button></a>
            </td>
            
              <!-- Modal añadir cliente-->
              <div class="modal fade" id="modalCliente{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Cliente</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{route("ventas.añadirCliente")}}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="txtidVentaTer" class="form-label">Id Venta</label>
                          <input type="number" class="form-control" id="txtidVentaTer"
                            aria-describedby="emailHelp" name="txtidVentaTer" value="{{$item->id}}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="txtNombreTer" class="form-label">Nombre</label>
                          <input type="text" class="form-control" id="txtNombreTer"
                            aria-describedby="emailHelp" name="txtNombreTer" value="{{$item->nombre_tercero}}">
                        </div>
                        <div class="mb-3">
                          <label for="txtIdentificacionTer" class="form-label">Indentificación</label>
                          <input type="number" class="form-control" id="txtIdentificacionTer"
                            aria-describedby="emailHelp" name="txtIdentificacionTer" value="{{$item->identificacion_tercero}}">
                        </div>
                        <div class="mb-3">
                          <label for="txtCorreoTer" class="form-label">Correo</label>
                          <input type="email" class="form-control" id="txtCorreoTer"
                            aria-describedby="emailHelp" name="txtCorreoTer" value="{{$item->correo}}">
                        </div>
                        <div class="mb-3">
                          <label for="txtTelefonoTer" class="form-label">Teléfono</label>
                          <input type="number" class="form-control" id="txtTelefonoTer"
                            aria-describedby="emailHelp" name="txtTelefonoTer" value="{{$item->telefono}}">
                        </div>
                        <div class="mb-3">
                          <label for="txtDireccionTer" class="form-label">Dirección</label>
                          <input type="text" class="form-control" id="txtDireccionTer"
                            aria-describedby="emailHelp" name="txtDireccionTer" value="{{$item->direccion}}">
                        </div>
                        <div class="mb-3">
                          <label for="txtTipoTer" class="form-label">Tipo Comprador</label>
                          <input type="text" class="form-control" id="txtTipoTer"
                            aria-describedby="emailHelp" name="txtTipoTer" value="{{$item->tipo_tercero}}">
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

              <!-- Modal modificar ingresos-->
              <div class="modal fade" id="modalEditar{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar registros de ventas</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form action="{{route("ventas.updateVenta")}}" method="POST">
                        @csrf
                        <div class="mb-3">
                          <label for="txtidVenta" class="form-label">Id Venta</label>
                          <input type="number" class="form-control" id="txtidVenta"
                            aria-describedby="emailHelp" name="txtidVenta" value="{{$item->id}}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="txtFecha" class="form-label">Fecha</label>
                          <input type="date" class="form-control" id="txtFecha"
                            aria-describedby="emailHelp" name="txtFecha" value="{{$item->fecha}}" readonly>
                        </div>
                        
                        <div class="mb-3">
                          <label for="txtProdNom" class="form-label">Nombre Producto</label>
                          <input type="taxt" class="form-control" id="txtProdNom"
                            aria-describedby="emailHelp" name="txtProdNom" value="{{$item->nombre_prod}}" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="txtProCant" class="form-label">Cantidad</label>
                          <input type="taxt" class="form-control" id="txtProCant"
                            aria-describedby="emailHelp" name="txtProCant" value="{{$item->cantidad}}">
                        </div>

                        <div class="mb-3">
                          <label for="txtIdProd" class="form-label">Id Producto</label>
                            <input type="text" class="form-control" id="txtIdProd"
                            aria-describedby="emailHelp" name="txtIdProd" value="{{$item->id_producto}}" readonly>
                           
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