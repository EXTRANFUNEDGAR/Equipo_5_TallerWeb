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

$data = json_decode(file_get_contents("php://input"));

$sql = "INSERT INTO usuario (usuario, contrasena) VALUES (?, ?)";
$statement = $conexion->prepare($sql);
$statement->bind_param("ss", $data->usuario, $data->contrasena);

if ($statement->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Error al insertar usuario: " . $conexion->error]);
}

$statement->close();
$conexion->close();
?>
