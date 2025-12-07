<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "bd_meowwoof";

$conn = mysqli_connect($host, $user, $pass, $db);

// Verificar conexión
if (!$conn) {
    die(" Error de conexión a la base de datos: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");

?>

