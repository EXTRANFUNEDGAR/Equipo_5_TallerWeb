<?php
// Permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");
// Permitir los métodos HTTP POST y OPTIONS
header("Access-Control-Allow-Methods: POST, OPTIONS");
// Permitir los encabezados Content-Type y X-Requested-With
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$baseDatos = "app-mult";

$conexion = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$sql = "SELECT id_usuario, usuario, contrasena FROM usuario";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    $usuarios = array();
    while ($row = $resultado->fetch_assoc()) {
        $usuarios[] = $row;
    }
    echo json_encode($usuarios);
} else {
    echo json_encode([]);
}

$conexion->close();
?>
