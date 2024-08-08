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

// Obtener todos los recibos de compras
$query_recibos = "SELECT * FROM ventas";
$resultado_recibos = mysqli_query($conn, $query_recibos);

if (!$resultado_recibos) {
    echo 'Error en la consulta de recibos: ' . mysqli_error($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informes de Compras</title>
    <link rel="icon" href="assets/images/favicon-new.ico" type="image/x-icon">
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
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
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
        <h1>Informes de Compras</h1>
        <a href="../menu.php" class="back-button">Regresar al Menú</a>
    </header>
    <main>
        <table>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Partido</th>
                <th>Cantidad</th>
                <th>Recibo</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($resultado_recibos)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['partido']); ?></td>
                    <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($row['recibo_texto'])); ?></td>
                </tr>
            <?php } ?>
        </table>
    </main>
    <footer>
        <p>&copy; 2024 Todos los derechos reservados</p>
    </footer>
</body>
</html>

<?php mysqli_close($conn); ?>
