<?php
session_start();
include 'conexion_io.php';

$usuario = $_POST['users'];
$contrasenia = $_POST['contrasenia'];
$contrasenia = hash('sha512', $contrasenia);

$usuario = mysqli_real_escape_string($conn, $usuario);
$contrasenia = mysqli_real_escape_string($conn, $contrasenia);

$validar = mysqli_query($conn, "SELECT * FROM user WHERE usuario = '$usuario' AND contrasenia = '$contrasenia'");

if(mysqli_num_rows($validar) > 0) {
    $_SESSION['users'] = $usuario;
    header("location: ../menu.php");
  // echo '
  // <script>
   //window.location = "../menu.php";
   //</script>
   //';
    exit;
} else {
    echo '
    <script>
    alert("Usuario inexistente");
    window.location = "../index.php";
    </script>
    ';
    exit;
}

mysqli_close($conn);
?>





?>