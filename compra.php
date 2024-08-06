<?php
session_start();
include 'conexion_io.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $partido = mysqli_real_escape_string($conn, $_POST['partido']);
    $cantidad = (int)$_POST['cantidad'];

    $query = "INSERT INTO ventas (nombre, partido, cantidad) VALUES ('$nombre', '$partido', $cantidad)";
    $resultado = mysqli_query($conn, $query);

    if ($resultado) {
        echo '
        <script>
        alert("Compra realizada con éxito");
        window.location = "index.php";
        </script>
        ';
    } else {
        echo '
        <script>
        alert("Hubo un error en la compra");
        window.location = "index.php";
        </script>
        ';
    }

    mysqli_close($conn);
} else {
    header("Location: index.php");
    exit();
}
?>
