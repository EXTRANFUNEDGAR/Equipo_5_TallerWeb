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

// Verificar la conexión a la base de datos
if ($conexionBD->connect_error) {
    die("Error de conexión: " . $conexionBD->connect_error);
}

$data = json_decode(file_get_contents("php://input"));
$id = isset($_POST["id"]) ? $_POST["id"] : null;
$usuario = $data->usuario;
$contrasena = $data->contrasena;

if ($contrasena != "" && $usuario != "" && $id !="") {
    //$sqlusuarios = "INSERT INTO usuario(usuario, contrasena, rango, status) VALUES ('$usuario','$contrasena','user','1')";
    $sqlusuarios = "UPDATE `usuario` SET `usuario`='$usuario',`contrasena`='$contrasena' WHERE id_usuario = '$id'";

    // Depurar la consulta SQL
    echo "Consulta SQL: " . $sqlusuarios . "<br>";

    if ($conexionBD->query($sqlusuarios) === TRUE) {
        echo json_encode(["success" => 1]);
    } else {
        echo json_encode(["error" => "Error al actualizar usuario: " . $conexionBD->error]);
    }
} else {
    echo json_encode(["error" => "Nombre de usuario y contraseña no pueden estar vacíos"]);
}

// Cerrar la conexión de base de datos
$conexionBD->close();
exit();
?>

