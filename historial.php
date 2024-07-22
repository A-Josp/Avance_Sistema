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
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hisotial</title>
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        main {
            padding: 2rem;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
            position: fixed;
            width: 100%;
            bottom: 0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Actividad Reciente</h1>
    </header>
    <main>
        <h2>Introducción</h2>
        <p>Esta es una página HTML de ejemplo. Puedes editar el contenido según tus necesidades.</p>
        <h2>Sección 1</h2>
        <p>Contenido de la primera sección.</p>
        <h2>Sección 2</h2>
        <p>Contenido de la segunda sección.</p>
    </main>
    <footer>
        <p>&copy; 2024 @Copyrigth todos los derechos reservados</p>
    </footer>
</body>
</html>