<?php
include('../config/Google.php');
include('../model/Usuario.php');

$login_button = '';
$mensajeId = '';
$invitacion = isset($_GET["invitacion"]) ? $_GET["invitacion"] : "";

if (isset($_GET["code"])) {

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

    if (!isset($token['error'])) {
        $google_client->setAccessToken($token['access_token']);
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        $_SESSION['access_token'] = $token['access_token'];

        $usuario_model = new pry_usuario();

        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }

        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }

        if (!empty($data['email'])) {
            $_SESSION['user_email_address'] = $data['email'];
            $_SESSION["usuario"] = $data['email'];

            $responseVerify = $usuario_model->verifyUser($data['email']);
            $usuarioFetch = pg_fetch_object($responseVerify);

            if ($usuarioFetch) {
                $_SESSION['usuarioFetch'] = $usuarioFetch->usuario;
            } else {
                $nombre = $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'];
                $responseVerify = $usuario_model->signup($nombre, $data['email'], '');
                // $_SESSION['usuarioFetch'] = $nombre . ' ' . $data['email'];
            }
        }

        if (!empty($data['gender'])) {
            $_SESSION['user_gender'] = $data['gender'];
        }

        if (!empty($data['picture'])) {
            $_SESSION['user_image'] = $data['picture'];
        }
    }
}

if ($invitacion) {
    $_SESSION['invitacion'] = $invitacion;
    // $mensajeId = "<h1>Estamos dentro $invitacion</h1>";
}

if (!isset($_SESSION['access_token'])) {
    $login_button = '<a 
        href="' . $google_client->createAuthUrl() . '"
        class="btn btn-block btn-danger"
    >
        <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
    </a>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posperu | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <link rel="shortcut icon" href="../dist/img/icon.png">

</head>

<body>
    <?php if ($mensajeId) echo $mensajeId; ?>
    <div class="hold-transition login-page">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card card-outline card-info">
                <div class="card-header text-center">
                    <a href="https://www.posperu.com/" target="_blank" class="h1"><b></b>POSPERU</a>
                </div>
                <div class="card-body">
                    <p class="login-box-msg">Iniciar sesión</p>

                    <form id="form-login">
                        <div class="input-group mb-3">
                            <input type="text" id="usuario" name="usuario" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="clave" name="clave" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                    </form>

                    <?php
                    if ($login_button == '') {
                        // echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
                        // echo '<h3><b>Name :</b> ' . $_SESSION['user_first_name'] . ' ' . $_SESSION['user_last_name'] . '</h3>';
                        // echo '<h3><b>User :</b> ' . $_SESSION['usuarioFetch'] . '</h3>';
                        // echo '<h3><b>Email :</b> ' . $_SESSION['user_email_address'] . '</h3>';
                        // echo '<h3><a href="logout.php">Logout</h3></div>';
                        header('location:principal');
                    } else {
                        echo '<div class="mt-3">' . $login_button . '</div>';
                    }
                    ?>
                </div>

                <p class="mt-2 text-center">
                    <a href="signup">¿No tienes una cuenta? Regístrate</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    </div>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>

    <script type="text/javascript" src="script/usuario.js"></script>
</body>

</html>