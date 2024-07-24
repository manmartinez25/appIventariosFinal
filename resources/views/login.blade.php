<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{!! asset('css/loginPageStyle.css') !!}">        
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

</head>
<body>
    <img class="wave" src="img/wave.png" alt="imagenFondo">
    <div class="container">
        <div class="img">
            <img src="img/profile_data.svg" alt="imagenContexto">
        </div>
        <div class="loginContainer">
            <form action="{{route('inicia-sesion')}}" method="POST">
                @csrf
                <img class="avatar" src="img/avatar.svg" alt="imgAvatar">
                <h2>Bienvenido</h2>
                <div class="inputDiv One">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h5>Usuario</h5>
                        <input class="input" name="email" type="email" required autocomplete="disable">
                    </div>
                </div>
                <div class="inputDiv Two">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h5>Contraseña</h5>
                        <input class="input" type="password" name="password" required>
                    </div>
                </div>
                <p>¿No tienes cuenta? <a href="{{route('registro')}}">Regístrate</a></p>
                    <input type="submit" class="btn" name="btnLogin" value="Login">
            </form>
        </div>
    </div>
    <script type="text/javascript" src="img/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>    

</body>
</html>