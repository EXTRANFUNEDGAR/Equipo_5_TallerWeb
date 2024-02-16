<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos con usuario, contraseña y nombre de la BD
$servidor = "localhost";
$usuariodb = "root";
$contrasenia = "";
$nombreBaseDatos = "app-mult";
$conexionBD = new mysqli($servidor, $usuariodb, $contrasenia, $nombreBaseDatos);

$data = json_decode(file_get_contents("php://input"));
$usuario = $data->usuario;
$contrasena = $data->contrasena;

$response = [];

if ($contrasena != "" && $usuario != "") {
    $sqlusuarios = "INSERT INTO usuario(usuario, contrasena, rango, status) VALUES ('$usuario','$contrasena','user','1')";

    if ($conexionBD->query($sqlusuarios) === TRUE) {
        $response["success"] = 1;
    } else {
        $response["error"] = "Error al insertar usuario: " . $conexionBD->error;
    }
} else {
    $response["error"] = "Nombre de usuario y contraseña no pueden estar vacíos";
}

// Asegúrate de que solo estás enviando JSON como respuesta
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

$conexionBD->close();
exit();

?>