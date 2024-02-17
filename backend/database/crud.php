<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos con usuario, contraseña y nombre de la BD
$servidor = "localhost";
$usuariodb = "root";
$contrasenia = "";
$nombreBaseDatos = "app-mult";
$conexionBD = new mysqli($servidor, $usuariodb, $contrasenia, $nombreBaseDatos);

$data = json_decode(file_get_contents("php://input"));

// Método GET: Obtener todos los usuarios
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $usuarios = [];
    $sql = "SELECT * FROM usuario";
    $result = $conexionBD->query($sql);
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $usuarios[] = $row;
        }
        echo json_encode($usuarios);
    } else {
        echo json_encode([]);
    }
}

// Método POST: Insertar un nuevo usuario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = isset($data->usuario) ? $data->usuario : '';
    $contrasena = isset($data->contrasena) ? $data->contrasena : '';
    $rango = isset($data->rango) ? $data->rango : '';
    $status = isset($data->status) ? $data->status : '';
    
    if (!empty($usuario) && !empty($contrasena) && !empty($rango) && !empty($status)) {
        $sql = "INSERT INTO usuario (usuario, contrasena, rango, status) VALUES ('$usuario', '$contrasena', '$rango', '$status')";
        if ($conexionBD->query($sql)) {
            echo json_encode(["message" => "Usuario insertado correctamente"]);
        } else {
            echo json_encode(["error" => "Error al insertar usuario: " . $conexionBD->error]);
        }
    } else {
        echo json_encode(["error" => "Por favor, proporcione todos los campos del usuario"]);
    }
}

// Método PUT: Actualizar un usuario
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    parse_str(file_get_contents("php://input"), $data);
    $id_usuario = isset($data['id_usuario']) ? $data['id_usuario'] : '';
    $usuario = isset($data['usuario']) ? $data['usuario'] : '';
    $contrasena = isset($data['contrasena']) ? $data['contrasena'] : '';
    $rango = isset($data['rango']) ? $data['rango'] : '';
    $status = isset($data['status']) ? $data['status'] : '';
    
    if (!empty($id_usuario) && !empty($usuario) && !empty($contrasena) && !empty($rango) && !empty($status)) {
        $sql = "UPDATE usuario SET usuario='$usuario', contrasena='$contrasena', rango='$rango', status='$status' WHERE id_usuario='$id_usuario'";
        if ($conexionBD->query($sql)) {
            echo json_encode(["message" => "Usuario actualizado correctamente"]);
        } else {
            echo json_encode(["error" => "Error al actualizar usuario: " . $conexionBD->error]);
        }
    } else {
        echo json_encode(["error" => "Por favor, proporcione todos los campos del usuario"]);
    }
}

// Método DELETE: Eliminar un usuario
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : '';
    if (!empty($id_usuario)) {
        $sql = "DELETE FROM usuario WHERE id_usuario='$id_usuario'";
        if ($conexionBD->query($sql)) {
            echo json_encode(["message" => "Usuario eliminado correctamente"]);
        } else {
            echo json_encode(["error" => "Error al eliminar usuario: " . $conexionBD->error]);
        }
    } else {
        echo json_encode(["error" => "ID de usuario no proporcionado"]);
    }
}

$conexionBD->close();
exit();
?>
