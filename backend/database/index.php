<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuariodb = "root"; $contrasenia = ""; $nombreBaseDatos = "app-mult";
$conexionBD = new mysqli($servidor, $usuariodb, $contrasenia, $nombreBaseDatos);


// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_POST["consultar"])){
    $sqlusuarios = mysqli_query($conexionBD,"SELECT * FROM usuario WHERE id=".$_POST["consultar"]);
    if(mysqli_num_rows($sqlusuarios) > 0){
        $usuarios = mysqli_fetch_all($sqlusuarios,MYSQLI_ASSOC);
        echo json_encode($usuarios);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_POST["borrar"])){
    $sqlusuarios = mysqli_query($conexionBD,"DELETE FROM usuario WHERE id=".$_POST["borrar"]);
    if($sqlusuarios){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if(isset($_POST["insertar"])){
    $data = json_decode(file_get_contents("php://input"));
    $usuario=$data->usuario;
    $contrasena=$data->$contrasena;
        if(($contrasena!="")&&($usuario!="")){
            
    $sqlusuarios = mysqli_query($conexionBD,"INSERT INTO usuario(usuario,contrasena,rango,status) VALUES('$nombre','$correo','user','1') ");
    echo json_encode(["success"=>1]);
        }
    exit();
}
// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if(isset($_POST["actualizar"])){
    
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_POST["actualizar"];
    $usuario=$data->usuario;
    $contrasena=$data->$contrasena;
    
    $sqlusuarios = mysqli_query($conexionBD,"UPDATE usuario SET usuario='$usuario',contrasena='$contrasena' WHERE id='$id'");
    echo json_encode(["success"=>1]);
    exit();
}
// Consulta todos los registros de la tabla empleados
$sqlusuarios = mysqli_query($conexionBD,"SELECT * FROM usuario ");
if(mysqli_num_rows($sqlusuarios) > 0){
    $usuarios = mysqli_fetch_all($sqlusuarios,MYSQLI_ASSOC);
    echo json_encode($usuarios);
}
else{ echo json_encode([["success"=>0]]); }


?>