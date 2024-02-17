<?php
// Permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");
// Permitir los métodos HTTP POST y OPTIONS
header("Access-Control-Allow-Methods: POST, OPTIONS");
// Permitir los encabezados Content-Type y X-Requested-With
header("Access-Control-Allow-Headers: Content-Type, X-Requested-With");
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Conexión a la base de datos
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$baseDatos = "app-mult";

$conexion = new mysqli($servidor, $usuario, $contrasena, $baseDatos);

// Verificar la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener datos enviados por POST
$data = json_decode(file_get_contents("php://input"));

// Verificar si se proporcionó un ID de usuario
if (!isset($data->id)) {
    echo json_encode(["error" => "No se proporcionó un ID de usuario"]);
    exit;
}

// Preparar consulta SQL para actualizar usuario
$sql = "UPDATE usuario SET usuario = ?, contrasena = ? WHERE id_usuario = ?";
$statement = $conexion->prepare($sql);
$statement->bind_param("ssi", $data->usuario, $data->contrasena, $data->id);

// Ejecutar consulta
if ($statement->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["error" => "Error al actualizar usuario: " . $conexion->error]);
}

// Cerrar conexión
$statement->close();
$conexion->close();
?>


