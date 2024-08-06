<?php
session_start();
include 'conexion_io.php';

// Verificar si la sesión está iniciada
if (!isset($_SESSION['users'])) {
    echo '
    <script>
        alert("Sesión no iniciada");
        window.location = "index.php";
    </script>';
    session_destroy();
    die();
}

$usuario = $_SESSION['users'];

// Consulta para obtener el historial de compras del usuario
$query = "SELECT * FROM ventas WHERE nombre = '$usuario'";
$resultado = mysqli_query($conn, $query);

if (!$resultado) {
    echo 'Error en la consulta: ' . mysqli_error($conn);
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Compras</title>
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
            position: relative;
        }
        .user-name {
            position: absolute;
            top: 1rem;
            right: 1rem;
            color: white;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 0.5rem;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        a.back-button {
            color: white;
            text-decoration: none;
            position: absolute;
            top: 1rem;
            left: 1rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>Historial de Compras</h1>
        <a href="menu.php" class="back-button">Volver al Menú</a>
        <div class="user-name"><?php echo htmlspecialchars($usuario); ?></div>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>Partido</th>
                    <th>Cantidad</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($resultado) > 0) { 
                    while ($row = mysqli_fetch_assoc($resultado)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['partido']); ?></td>
                    <td><?php echo htmlspecialchars($row['cantidad']); ?></td>
                </tr>
                <?php } 
                } else { ?>
                <tr>
                    <td colspan="2">No hay compras registradas</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
    <footer>
        <p>&copy; 2024 @Copyright todos los derechos reservados</p>
    </footer>
</body>
</html>

<?php mysqli_close($conn); ?>

