<?php
session_start();

if(isset($_SESSION['users'])){

header("location: ../menu.php ");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion</title>
    <link rel="icon" href="assets/images/favicon2.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/estilos.css">
</head>
<body>
<div class="video-background">
        <video autoplay loop muted>
            <source src="assets/images/pruebaRe3.mp4" type="video/mp4">
            Tu navegador no soporta el elemento de video.
        </video>
    </div>

    <div class="logo">
        <img src="assets/images/LOgNGL.png" alt="Logo">
    </div>

    <main>
        <div class="contenedor__todo">
            <div class="caja__trasera">
                <div class="caja__trasera-login">
                    <h3>Iniciar Sesión</h3>
                    <p>¡Empieza ya!</p>
                    <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                </div>
                <div class="caja__trasera-register">
                    <h3>¿Desea Registrarse?</h3>
                    <p>¡Entra Aquí!</p>
                    <button id="btn__registrarse">Regístrarse</button>
                </div>
            </div>

         <!--Formulario de Login y registro-->
         <div class="contenedor__login-register">
                <!--Login-->
                <form action="php/login.php" method="POST" class="formulario__login">
                    <h2>Inicio de Sesión</h2>
                    <input type="text" placeholder="Usuario" name="users">
                    <input type="password" placeholder="Contraseña" name="contrasenia">
                    <button>Entrar</button>
                </form>

                <!--Register-->
                <form action="php/registro_user.php" method="POST" class="formulario__register">
                    <h2> </h2>
                    <h2>Regístro</h2>
                    <input type="text" placeholder="Usuario" name="users">
                    <input type="password" placeholder="Contraseña" name="contrasenia">
                    <input type="text" placeholder="Nombre completo" name="nombre">
                    <input type="email" placeholder="Correo Electrónico" name="correo">
                    <input type="text" placeholder="Teléfono" name="telefono">
                    <input type="text" placeholder="Dirección" name="direccion">
                    <input type="date" id="fecha-ingreso" placeholder="Fecha de ingreso" name="fecha">
                    <button>Regístrarse</button>
                </form>
            </div>
        </div>
    </main>

    <script src="assets/js/script.js"></script>
</body>
</html>
