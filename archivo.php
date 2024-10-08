<?php
session_start();

if(!isset($_SESSION['users'])){
    echo '
    <script>
        alert("Sesion no iniciada");
        window.location = "index.php";
    </script>';
    session_destroy();
    die();  
}

$target_dir = "../uploads/"; // Carpeta donde se guardarán las fotos
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Verificar si el archivo es una imagen real
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "El archivo es una imagen - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "El archivo no es una imagen.";
        $uploadOk = 0;
    }
}

// Verificar si el archivo ya existe
if (file_exists($target_file)) {
    echo "Lo siento, el archivo ya existe.";
    $uploadOk = 0;
}

// Limitar el tamaño del archivo (5MB)
if ($_FILES["fileToUpload"]["size"] > 5000000) {
    echo "Lo siento, el archivo es demasiado grande.";
    $uploadOk = 0;
}

// Permitir ciertos formatos de archivo
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Lo siento, solo se permiten archivos JPG, JPEG, PNG y GIF.";
    $uploadOk = 0;
}

// Verificar si $uploadOk es 0 por algún error
if ($uploadOk == 0) {
    echo "Lo siento, tu archivo no fue subido.";
// Intentar subir el archivo
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $_SESSION['uploaded_image'] = basename($_FILES["fileToUpload"]["name"]);
        echo "El archivo ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " ha sido subido.";
        header("Location: ../menu.php");
    } else {
        echo "Lo siento, hubo un error al subir tu archivo.";
    }
}
?>

