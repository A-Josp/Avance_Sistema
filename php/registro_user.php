<?php
include 'conexion_io.php';

// Recibir datos del formulario
$nombre = $_POST['nombre'];
$users = $_POST['users'];
$direccion = $_POST['direccion'];
$correo = $_POST['correo'];
$contrasenia = $_POST['contrasenia'];
$contrasenia = hash('sha512', $contrasenia);
$fecha = $_POST['fecha'];
$telefono = $_POST['telefono'];

// Consulta SQL para insertar los datos en la base de datos
$query = "INSERT INTO user(nombre, usuario, direccion, correo, contrasenia, fecha, telefono)
          VALUES ('$nombre', '$users', '$direccion', '$correo', '$contrasenia', '$fecha', '$telefono')";

$verificar_email = mysqli_query($conn, "SELECT * FROM user WHERE correo = '$correo'");

if (mysqli_num_rows($verificar_email) > 0) {
    echo '
    <script>
    alert("El correo ya se encuentra registrado");
    window.location = "../index.php"; 
    </script>  
    ';
    exit();
}

$verificar_user = mysqli_query($conn, "SELECT * FROM user WHERE usuario = '$users'");

if (mysqli_num_rows($verificar_user) > 0) {
    echo '
    <script>
    alert("El usuario ya se encuentra registrado");
    window.location = "../index.php"; 
    </script>  
    ';
    exit();
}

$resultado = mysqli_query($conn, $query);

if ($resultado) {
    echo "Registro exitoso.";
} else {
    echo "Hubo un error en el registro.";
}

if ($resultado) {
    echo '
    <script>
    alert("Registro exitoso");
    window.location = "../index.php";
    </script>
    ';
} else {
    echo '
    <script>
    alert("Hubo un error en el registro");
    window.location = "../index.php";
    </script>
    ';
}

mysqli_close($conn);
?>

