<?php

$conn = mysqli_connect("localhost", "root", "", "ngl");

if ($conn) {
    echo 'Conexión exitosa';
   }
else{
    echo "Conexion fallida";}
?>