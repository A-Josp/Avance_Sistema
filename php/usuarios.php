<?php
session_start();

if (!isset($_SESSION['users'])) {
    echo '
    <script>
        alert("Sesión no iniciada");
        window.location = "index.php";
    </script>';
    session_destroy();
    die();
}

include 'conexion_io.php';

// Manejo de creación de usuarios
if (isset($_POST['create_user'])) {
    $usuario = $_POST['usuario'];
    $contrasenia = hash('sha512', $_POST['contrasenia']);
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    
    $query = "INSERT INTO user (usuario, contrasenia, nombre, correo) VALUES ('$usuario', '$contrasenia', '$nombre', '$correo')";
    mysqli_query($conn, $query);
}

// Manejo de actualización de usuarios
if (isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $usuario = $_POST['usuario'];
    $contrasenia = hash('sha512', $_POST['contrasenia']);
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    
    $query = "UPDATE user SET usuario='$usuario', contrasenia='$contrasenia', nombre='$nombre', correo='$correo' WHERE id='$id'";
    mysqli_query($conn, $query);
}

// Manejo de eliminación de usuarios
if (isset($_GET['delete_user'])) {
    $id = $_GET['delete_user'];
    $query = "DELETE FROM user WHERE id='$id'";
    mysqli_query($conn, $query);
}

$result = mysqli_query($conn, "SELECT * FROM user");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
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
            margin-bottom: 4rem; /* Ajusta esto según la altura del footer */
        }
        footer {
            background-color: rgba(0, 0, 0, 0.5); /* Fondo negro con transparencia */
            color: white;
            text-align: center;
            padding: 1rem;
            position: fixed;
            width: 100%;
            bottom: 0;
            height: 4rem; /* Asegúrate de que coincida con el margen inferior del main */
        }
        form {
            margin-bottom: 2rem;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #333;
            color: white;
        }
        button, input[type="submit"] {
            padding: 8px 16px;
            margin-top: 8px;
        }
        #editUserForm {
            display: none;
            margin-top: 2rem;
        }
    </style>
</head>
<body>
    <header>
        <h1>Usuarios Registrados</h1>
    </header>
    <main>
        <h2>Crear Usuario</h2>
        <form action="usuarios.php" method="post">
            <label for="usuario">Usuario:</label>
            <input type="text" name="usuario" id="usuario" required>
            <label for="contrasenia">Contraseña:</label>
            <input type="password" name="contrasenia" id="contrasenia" required>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
            <label for="correo">Correo:</label>
            <input type="email" name="correo" id="correo" required>
            <input type="submit" value="Crear Usuario" name="create_user">
        </form>

        <h2>Usuarios Registrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['usuario']); ?></td>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['correo']); ?></td>
                    <td>
                        <button onclick="editUser(<?php echo $row['id']; ?>, '<?php echo htmlspecialchars($row['usuario']); ?>', '<?php echo htmlspecialchars($row['nombre']); ?>', '<?php echo htmlspecialchars($row['correo']); ?>')">Editar</button>
                        <a href="usuarios.php?delete_user=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">Eliminar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div id="editUserForm">
            <h2>Editar Usuario</h2>
            <form action="usuarios.php" method="post">
                <input type="hidden" name="id" id="edit_id">
                <label for="edit_usuario">Usuario:</label>
                <input type="text" name="usuario" id="edit_usuario" required>
                <label for="edit_contrasenia">Contraseña:</label>
                <input type="password" name="contrasenia" id="edit_contrasenia" required>
                <label for="edit_nombre">Nombre:</label>
                <input type="text" name="nombre" id="edit_nombre" required>
                <label for="edit_correo">Correo:</label>
                <input type="email" name="correo" id="edit_correo" required>
                <input type="submit" value="Actualizar Usuario" name="update_user">
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 @Copyrigth todos los derechos reservados</p>
    </footer>

    <script>
        function editUser(id, usuario, nombre, correo) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_usuario').value = usuario;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_correo').value = correo;
            document.getElementById('editUserForm').style.display = 'block';
        }
    </script>
</body>
</html>

<?php
mysqli_close($conn);
?>

