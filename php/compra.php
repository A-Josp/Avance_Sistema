<?php
session_start();
include 'conexion_io.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $partido_id = mysqli_real_escape_string($conn, $_POST['partido']);
    $cantidad = (int)$_POST['cantidad'];

    // Obtener la información del partido
    $query_partido = "SELECT * FROM partidos WHERE id = $partido_id";
    $resultado_partido = mysqli_query($conn, $query_partido);
    $partido = mysqli_fetch_assoc($resultado_partido);

    if (!$partido) {
        echo '
        <script>
        alert("Partido no encontrado");
        window.location = "mercado.php";
        </script>
        ';
        exit();
    }

    // Generar el texto del recibo
    $recibo_texto = "Recibo de Compra:\n";
    $recibo_texto .= "Nombre: $nombre\n";
    $recibo_texto .= "Partido: " . $partido['descripcion'] . "\n";
    $recibo_texto .= "Fecha: " . $partido['fecha'] . "\n";
    $recibo_texto .= "Hora: " . $partido['hora'] . "\n";
    $recibo_texto .= "Estadio: " . $partido['estadio'] . "\n";
    $recibo_texto .= "Cantidad de Boletos: $cantidad\n";

    $query = "INSERT INTO ventas (nombre, partido, cantidad, recibo_texto) VALUES ('$nombre', $partido_id, $cantidad, '$recibo_texto')";
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


