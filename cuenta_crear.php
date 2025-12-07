<?php
$servername = "localhost";   
$username   = "root";       
$password   = "";           
$database   = "bd_MeowWoof"; 

// Crear conexión
$conexion = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}

$conexion->set_charset("utf8");
?>