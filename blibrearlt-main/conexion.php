<?php
$host = "localhost";
$usuario = "root";
$password = ""; // En XAMPP por defecto está vacía
$base_datos = "libreria_donaciones";

$conexion = new mysqli($host, $usuario, $password, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
$conexion->set_charset("utf8");
?>