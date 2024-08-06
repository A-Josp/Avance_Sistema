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

// Obtener la lista de partidos disponibles
$query_partidos = "SELECT * FROM partidos";
$resultado_partidos = mysqli_query($conn, $query_partidos);

if (!$resultado_partidos) {
    echo 'Error en la consulta de partidos: ' . mysqli_error($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Compra de Boletos</title>
    <link rel="icon" href="assets/images/favicon-new.ico" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('assets/images/vs.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
        }
        header {
            background-color: #333;
            color: white;
            padding: 1rem;
            text-align: center;
        }
        main {
            padding: 2rem;
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(100vh - 160px);
        }
        form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
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
        <h1>Mercado</h1>
        <a href="../menu.php" class="back-button">Regresar al Menú</a>
    </header>
    <main>
        <form action="compra.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
            
            <label for="partido">Partido:</label>
            <select name="partido" id="partido" required>
                <option value="">Seleccione un partido</option>
                <?php while ($row = mysqli_fetch_assoc($resultado_partidos)) { ?>
                    <option value="<?php echo htmlspecialchars($row['id']); ?>">
                        <?php echo htmlspecialchars($row['descripcion']) . ' - ' . htmlspecialchars($row['fecha']) . ' ' . htmlspecialchars($row['hora']); ?>
                    </option>
                <?php } ?>
            </select>
            
            <label for="cantidad">Cantidad de Boletos:</label>
            <input type="number" name="cantidad" id="cantidad" min="1" max="10" required>
            
            <input type="submit" value="Comprar Boletos">
        </form>
    </main>
    <footer>
        <p>&copy; 2024 Todos los derechos reservados</p>
    </footer>
</body>
</html>

<?php mysqli_close($conn); ?>



