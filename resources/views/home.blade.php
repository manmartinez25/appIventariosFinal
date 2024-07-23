<!DOCTYPE html>
<html>
    <head>
        <title>Principal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" >
        <link rel="stylesheet" href="{!! asset('css/styleHome.css') !!}">        
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/a81368914c.js"></script>
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
                  <a class="nav-link active" aria-current="page" href="{{ route('home.home') }}">Home</a>
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
        
        <div class="containerCards">
            <div class="card" style="width: 18rem;">
                <img src="img/products.svg" class="card-img-top" alt="imgProductos">
                <div class="card-body">
                  <h5 class="card-title">Productos</h5>
                  <p class="card-text">Gestiona nuevos productos</p>
                  <a href="{{ route('product.gestProducts') }}" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
              <div class="card" style="width: 18rem;">
                <img src="img/products.svg" class="card-img-top" alt="imgProductos">
                <div class="card-body">
                  <h5 class="card-title">Ingresos</h5>
                  <p class="card-text">Gestiona el ingreso de productos</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
              <div class="card" style="width: 18rem;">
                <img src="img/products.svg" class="card-img-top" alt="imgProductos">
                <div class="card-body">
                  <h5 class="card-title">Ventas</h5>
                  <p class="card-text">Gestiona procesos de ventas</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
              <div class="card" style="width: 18rem;">
                <img src="img/products.svg" class="card-img-top" alt="imgProductos">
                <div class="card-body">
                  <h5 class="card-title">Inventarios</h5>
                  <p class="card-text">Gestiona tus inventarios</p>
                  <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
              </div>
        </div>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    
    </body>
</html>