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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGL - Venta de Boletos</title>
    <link rel="stylesheet" href="assets/css/Style2.css">
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        header, main, nav {
            padding: 20px;
            position: relative;
            z-index: 2;
        }
        .overlay-top, .overlay-bottom {
            position: absolute;
            width: 100%;
            height: 100px; /* Ajusta la altura según sea necesario */
            background: rgba(0, 0, 0, 0.5); /* Fondo negro transparente */
            z-index: 1;
        }
        .overlay-top {
            top: 0;
        }
        .overlay-bottom {
            bottom: 0;
        }
        .menu-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: relative;
        }
        .menu-icon {
            background: none;
            border: none;
            cursor: pointer;
            padding: 10px;
        }
        .menu-icon .line {
            width: 25px;
            height: 3px;
            background: #fff;
            margin: 5px 0;
        }
        .menu-options {
            display: none;
            position: absolute;
            top: 40px;
            left: 0;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            z-index: 2;
        }
        .menu-options a {
            display: block;
            padding: 10px;
            text-decoration: none;
            color: #333;
        }
        .menu-options a:hover {
            background: #f0f0f0;
        }
        h1, h2 {
            margin: 0;
            color: #fff;
        }
        form {
            margin-top: 20px;
        }
        .hidden {
            display: none;
        }
    </style>
</head>
<body>
    <div class="overlay-top"></div>
    <header>
        <nav class="menu-container">
            <h1>Menú</h1>
            <button class="menu-icon" onclick="toggleMenu()" aria-label="Toggle menu">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </button>
            <div class="menu-options" id="menuOptions">
                <a href="php/usuarios.php">Usuarios</a>
                <a href="php/mercado.php">Mercado</a>
                <a href="php/historial.php">Historial</a>
                <a href="php/logout.php">Cerrar Sesión</a>
            </div>
        </nav>
    </header>
    
    <main>
        <section>
            <h2>Misión</h2>
            <p>Proveer una plataforma eficiente y segura para la compra y venta de boletos, ofreciendo a nuestros usuarios una experiencia fácil e intuitiva, y garantizando la mejor atención al cliente para asegurar la satisfacción en cada transacción.</p>
        </section>
        
        <section>
            <h2>Visión</h2>
            <p>Ser la aplicación líder en venta de boletos en el mercado, reconocida por su innovación, confiabilidad y compromiso con la excelencia, conectando a las personas con sus eventos favoritos de manera rápida y segura.</p>
        </section>
        
        <section>
            <h2>Subir una Foto</h2>
            <form action="php/archivo.php" method="post" enctype="multipart/form-data">
                <label for="fileToUpload">Selecciona una foto:</label>
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input type="submit" value="Subir Foto" name="submit">
            </form>
            <button id="showImageBtn">Mostrar Imagen</button>
            <div id="imageContainer" class="hidden">
                <img id="uploadedImage" src="" alt="Imagen subida">
            </div>
        </section>
    </main>

    <div class="overlay-bottom"></div>

    <script src="assets/js/joys.js"></script>
    <script>
        function toggleMenu() {
            var menuOptions = document.getElementById('menuOptions');
            if (menuOptions.style.display === 'block') {
                menuOptions.style.display = 'none';
            } else {
                menuOptions.style.display = 'block';
            }
        }

        document.getElementById('showImageBtn').addEventListener('click', function() {
            console.log('Botón "Mostrar Imagen" clicado'); // Mensaje de depuración
            var imageContainer = document.getElementById('imageContainer');
            var uploadedImage = document.getElementById('uploadedImage');
            var uploadedImageName = '<?php echo isset($_SESSION["uploaded_image"]) ? $_SESSION["uploaded_image"] : ''; ?>';
            if (uploadedImageName) {
                uploadedImage.src = "../uploads/" + uploadedImageName;
                imageContainer.classList.remove('hidden');
            } else {
                alert('No hay imagen para mostrar.');
            }
        });
    </script>
</body>
</html>








