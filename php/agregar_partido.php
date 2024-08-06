<?php
session_start();
include 'conexion_io.php';

if (!isset($_SESSION['users'])) {
    echo '
    <script>
        alert("Sesión no iniciada");
        window.location = "index.php";
    </script>';
    session_destroy();
    die();
}

// Procesar el formulario cuando se envía
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_partido = mysqli_real_escape_string($conn, $_POST['nombre_partido']);
    $fecha = mysqli_real_escape_string($conn, $_POST['fecha']);
    $hora = mysqli_real_escape_string($conn, $_POST['hora']);
    $estadio = mysqli_real_escape_string($conn, $_POST['estadio']);

    $query = "INSERT INTO partidos (descripcion, fecha, hora, estadio) VALUES ('$nombre_partido', '$fecha', '$hora', '$estadio')";
    $resultado = mysqli_query($conn, $query);

    if ($resultado) {
        echo '
        <script>
        alert("Partido agregado con éxito");
        window.location = "agregar_partido.php";
        </script>
        ';
    } else {
        echo '
        <script>
        alert("Hubo un error al agregar el partido");
        window.location = "agregar_partido.php";
        </script>
        ';
    }

    mysqli_close($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Partido</title>
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
        form {
            background-color: #fff;
            padding: 2rem;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        form input {
            width: 100%;
            padding: 0.5rem;
            margin: 0.5rem 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        form button {
            padding: 0.7rem 2rem;
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }
        form button:hover {
            background-color: #555;
        }
        a.back-button {
            color: white;
            text-decoration: none;
            position: absolute;
            top: 1rem;
            right: 1rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>Agregar Partido</h1>
        <a href="../menu.php" class="back-button">Volver al Menú</a>
    </header>
    <main>
        <form action="agregar_partido.php" method="post">
            <label for="nombre_partido">Nombre del Partido:</label>
            <input type="text" id="nombre_partido" name="nombre_partido" required>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>

            <label for="hora">Hora:</label>
            <input type="time" id="hora" name="hora" required>

            <label for="estadio">Estadio:</label>
            <input type="text" id="estadio" name="estadio" required>

            <button type="submit">Agregar Partido</button>
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Todos los derechos reservados</p>
    </footer>
</body>
</html>



