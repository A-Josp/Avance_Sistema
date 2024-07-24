<?php
session_start();

if(!isset($_SESSION['users'])){
    echo '
    <script>
        alert("Sesión no iniciada");
        window.location = "index.php";
    </script>';
    session_destroy();
    die();  
}

include('config.php');

// Crear usuario
if(isset($_POST['create_user'])) {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";
    $conn->query($query);
}

// Actualizar usuario
if(isset($_POST['update_user'])) {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "UPDATE usuarios SET nombre='$nombre', email='$email', password='$password' WHERE id=$id";
    $conn->query($query);
}

// Eliminar usuario
if(isset($_GET['delete_user'])) {
    $id = $_GET['delete_user'];
    $query = "DELETE FROM usuarios WHERE id=$id";
    $conn->query($query);
}

// Obtener todos los usuarios
$query = "SELECT * FROM usuarios";
$result = $conn->query($query);

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
            background-image: url('../images/vs.jpg');
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
        <h1>Usuarios Registrados</h1>
    </header>
    <main>
        <h2>Crear Usuario</h2>
        <form action="usuarios.php" method="post">
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" required>
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            <input type="submit" value="Crear Usuario" name="create_user">
        </form>

        <h2>Usuarios Registrados</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['nombre']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td>
                        <button onclick="editUser(<?php echo $row['id']; ?>, '<?php echo $row['nombre']; ?>', '<?php echo $row['email']; ?>')">Editar</button>
                        <a href="usuarios.php?delete_user=<?php echo $row['id']; ?>" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?')">Eliminar</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <div id="editUserForm" style="display:none;">
            <h2>Editar Usuario</h2>
            <form action="usuarios.php" method="post">
                <input type="hidden" name="id" id="edit_id">
                <label for="edit_nombre">Nombre:</label>
                <input type="text" name="nombre" id="edit_nombre" required>
                <label for="edit_email">Email:</label>
                <input type="email" name="email" id="edit_email" required>
                <label for="edit_password">Password:</label>
                <input type="password" name="password" id="edit_password" required>
                <input type="submit" value="Actualizar Usuario" name="update_user">
            </form>
        </div>
    </main>
    <footer>
        <p>&copy; 2024 @Copyrigth todos los derechos reservados</p>
    </footer>

    <script>
        function editUser(id, nombre, email) {
            document.getElementById('edit_id').value = id;
            document.getElementById('edit_nombre').value = nombre;
            document.getElementById('edit_email').value = email;
            document.getElementById('editUserForm').style.display = 'block';
        }
    </script>
</body>
</html>
