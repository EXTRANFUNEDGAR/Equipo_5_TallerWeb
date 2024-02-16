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

$id = isset($_POST["id"]) ? $_POST["id"] : null;
$usuario = $data->usuario;
$contrasena = $data->contrasena;

$sqlusuarios = mysqli_query($conexionBD, "UPDATE usuario SET usuario='$usuario',contrasena='$contrasena' WHERE id='$id'");
echo json_encode(["success" => 1]);
exit();
?>
