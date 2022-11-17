<?php
require_once "../model/Usuario.php";

ob_start();
if (strlen(session_id()) < 1) {
    session_start();
}

$usuarioModel = new pry_usuario();

// LOGUEAR USUARIO
$idUsuario = isset($_POST["idUsuario"]) ? $_POST["idUsuario"] : "";
$emailLogin = isset($_POST["login-email"]) ? $_POST["login-email"] : "";
$passwordLogin = isset($_POST["login-password"]) ? $_POST["login-password"] : "";

// REGISTRAR USUARIO
$usernameRegister = isset($_POST["register-username"]) ? $_POST["register-username"] : "";
$emailRegister = isset($_POST["register-email"]) ? $_POST["register-email"] : "";
$passwordRegister = isset($_POST["register-password"]) ? $_POST["register-password"] : "";

switch ($_GET["op"]) {
        // case 'signup':
        //     $response = $usuarioModel->signup(
        //         $usernameRegister,
        //         $emailRegister,
        //         $passwordRegister,
        //     );
        //     echo $response;
        //     break;

    case 'listarUsuarios':
        $response = $usuarioModel->listarUsuarios();
        $usuarios = [];

        while ($reg = mysqli_fetch_object($response)) {
            array_push($usuarios, $reg);
        }
        echo json_encode($usuarios);
        break;

    case 'eliminarUsuario':
        $response = $usuarioModel->eliminarUsuario(
            $idUsuario
        );
        echo $response;
        break;
}

ob_end_flush();