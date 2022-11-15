<?php
// include('../model/Usuario.php');

$invitacion = isset($_GET["invitacion"]) ? $_GET["invitacion"] : "";

if ($invitacion) {
    $_SESSION['invitacion'] = $invitacion;
}

$login_button = '';

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <link rel="shortcut icon" href="../dist/img/icon.png">

    <meta name="author" content="PIXINVENT">
    <title>Iniciar sesión - Yauripet</title>
    <?php require_once('./partials/header.php') ?>
</head>
<!-- END: Head-->


<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu blank-page navbar-floating footer-static  " data-open="hover"
    data-menu="horizontal-menu" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-v1 px-2">
                    <div class="auth-inner py-2">
                        <!-- Login v1 -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="javascript:void(0);" class="brand-logo">
                                    <h2 class="brand-text text-primary ml-1">🐶 YAURIPET</h2>
                                </a>

                                <h4 class="card-title mb-1">Bienvenido a Yauripet! 👋</h4>
                                <p class="card-text mb-2">Inicie sesión en su cuenta y comience la aventura</p>

                                <form class="auth-login-form mt-2" id="form-login">
                                    <div class="form-group">
                                        <label for="login-email" class="form-label">Correo electrónico</label>
                                        <input type="text" class="form-control" id="login-email" name="login-email"
                                            placeholder="yauripet@yauripet.com" aria-describedby="login-email"
                                            tabindex="1" autofocus />
                                    </div>

                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                            <label for="login-password">Contraseña</label>
                                            <a href="page-auth-forgot-password-v1.html">
                                                <small>¿Olvidó su contraseña?</small>
                                            </a>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge"
                                                id="login-password" name="login-password" tabindex="2"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="login-password" minlength="4" />
                                            <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer"><i
                                                        data-feather="eye"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" id="remember-me"
                                                tabindex="3" />
                                            <label class="custom-control-label" for="remember-me"> Recuérdame </label>
                                        </div>
                                    </div> -->
                                    <button class="btn btn-primary btn-block" tabindex="4">Iniciar sesión</button>
                                </form>

                                <!-- <p class="text-center mt-2">
                                    <span>¿Nuevo en nuestra plataforma?</span>
                                    <a href="signup">
                                        <span>Crea una cuenta</span>
                                    </a>
                                </p>

                                <div class="divider my-2">
                                    <div class="divider-text">o</div>
                                </div>

                                <div class="auth-footer-btn d-flex justify-content-center">
                                    <a href="javascript:void(0)" class="btn btn-facebook">
                                        <i data-feather="facebook"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="btn btn-twitter white">
                                        <i data-feather="twitter"></i>
                                    </a>
                                    <?php
                                    echo  $login_button;
                                    ?>
                                    <a href="javascript:void(0)" class="btn btn-github">
                                        <i data-feather="github"></i>
                                    </a>
                                </div>
                                 -->
                            </div>
                        </div>
                        <!-- /Login v1 -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <?php require_once('./partials/scripts.php') ?>

    <script type="text/javascript" src="script/login.js"></script>
    <script type="text/javascript" src="script/helper.js"></script>
</body>
<!-- END: Body-->

</html>