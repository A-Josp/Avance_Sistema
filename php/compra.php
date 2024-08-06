<?php
session_start();
include 'conexion_io.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recogemos el nombre del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $partido_id = mysqli_real_escape_string($conn, $_POST['partido']);
    $cantidad = (int)$_POST['cantidad'];

    $query = "INSERT INTO ventas (nombre, partido, cantidad) VALUES ('$nombre', '$partido_id', $cantidad)";
    $resultado = mysqli_query($conn, $query);

    if ($resultado) {
        echo '
        <script>
        alert("Compra realizada con éxito");
        window.location = "../menu.php";
        </script>
        ';
    } else {
        echo '
        <script>
        alert("Hubo un error en la compra");
        window.location = "mercado.php";
        </script>
        ';
    }

    mysqli_close($conn);
} else {
    header("Location: mercado.php");
    exit();
}
?>

