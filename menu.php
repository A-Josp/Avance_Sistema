<?php
session_start();

if(!isset($_SESSION['users'])){
    echo '
    <script>
        alert("Sesión no iniciada");
        window.location = "index.php";
    </script>';
    session_destroy();
    die();  
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="assets/css/Style2.css">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <header>
        <nav class="menu-container">
            <button class="menu-icon" onclick="toggleMenu()" aria-label="Toggle menu">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </button>
            <h1 class="menu-title">Menú</h1>
            <div class="menu-options" id="menuOptions">
                <a href="php/usuarios.php">Usuarios</a>
                <a href="php/agregar_partido.php">Agregar Partido</a>
                <a href="php/mercado.php">Mercado</a>
                <a href="php/historial.php">Historial</a>
                <a href="php/logout.php">Cerrar Sesión</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="mission-vision">
            <div class="content">
                <h2>Nuestra Misión</h2>
                <p>Nuestra misión es ofrecer a nuestros clientes una experiencia de compra de boletos fácil, rápida y segura, proporcionando acceso a una amplia gama de eventos en todo el mundo. Nos esforzamos por ofrecer el mejor servicio al cliente y la mayor comodidad posible, utilizando la tecnología más avanzada para garantizar que cada transacción sea fluida y sin problemas.</p>
                <h2> </h2>
                <h2>Nuestra Visión</h2>
                <p>Nuestra visión es convertirnos en la plataforma líder mundial en la venta de boletos, reconocida por nuestra innovación, confiabilidad y compromiso con la satisfacción del cliente. Aspiramos a conectar a personas de todas partes con experiencias inolvidables, facilitando el acceso a eventos de entretenimiento, deportes, cultura y más, a través de una plataforma intuitiva y de confianza.</p>
            </div>
        </section>
    </main>

    <script>
        function toggleMenu() {
            var menuOptions = document.getElementById('menuOptions');
            menuOptions.classList.toggle('show');
        }
    </script>
</body>
</html>



















