<?php
session_start();

if(!isset($_SESSION['users'])){
    echo '
    <script>
        alert("Sesion no iniciada");
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
    <title>NGL</title>
    <link rel="stylesheet" href="assets/css/Style2.css">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="menu-container">
        <button class="menu-icon" onclick="toggleMenu()" aria-label="Toggle menu">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </button>
        <div class="menu-options" id="menuOptions">
            <a href="#">Opción 1</a>
            <a href="#">Opción 2</a>
            <a href="#">Opción 3</a>
            <a href="php/logout.php">Cerrar Sesión</a>
        </div>
    </div>
    <h1>Menú</h1>
    <script src="assets/js/joys.js"></script>
</body>
</html>


