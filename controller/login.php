<?php
require_once "../model/Usuario.php";

ob_start();
if (strlen(session_id()) < 1) {
    session_start();
}

$usuarioModel = new pry_usuario();

// LOGUEAR USUARIO
$emailLogin = isset($_POST["login-email"]) ? $_POST["login-email"] : "";
$passwordLogin = isset($_POST["login-password"]) ? $_POST["login-password"] : "";

// REGISTRAR USUARIO
$usernameRegister = isset($_POST["register-username"]) ? $_POST["register-username"] : "";
$emailRegister = isset($_POST["register-email"]) ? $_POST["register-email"] : "";
$passwordRegister = isset($_POST["register-password"]) ? $_POST["register-password"] : "";

switch ($_GET["op"]) {
    case 'login':
        $response = $usuarioModel->login(
            $emailLogin,
            $passwordLogin
        );

        $usuarioFetch = mysqli_fetch_object($response);

        if ($usuarioFetch) {
            $_SESSION['id_usuario'] = $usuarioFetch->id;
            $_SESSION['nombre'] = $usuarioFetch->nombre;
            $_SESSION['usuario'] = $usuarioFetch->usuario;

            echo json_encode($usuarioFetch);
        }
        break;

    case 'signup':
        $response = $usuarioModel->signup(
            $usernameRegister,
            $emailRegister,
            $passwordRegister,
        );
        echo $response;
        break;
}

ob_end_flush();