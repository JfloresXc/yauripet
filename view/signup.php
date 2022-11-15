<?php
if (strlen(session_id()) < 1)
    session_start();
?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->


<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Register Page - Vuexy - Bootstrap HTML admin template</title>

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
                        <!-- Register v1 -->
                        <div class="card mb-0">
                            <div class="card-body">
                                <a href="login" class="brand-logo">
                                    <h2 class="brand-text text-primary ml-1">POSPERU</h2>
                                </a>

                                <h4 class="card-title mb-1">Las aventuras inician aquí 🚀</h4>
                                <p class="card-text mb-2">Regístrese de manera sencilla !</p>

                                <form class="auth-register-form mt-2" id="form-signup">
                                    <div class="form-group">
                                        <label for="register-username" class="form-label">Nombre completo</label>
                                        <input type="text" class="form-control" id="register-username"
                                            name="register-username" placeholder="Juan Perez Alva"
                                            aria-describedby="register-username" tabindex="1" autofocus />
                                    </div>
                                    <div class="form-group">
                                        <label for="register-email" class="form-label">Correo electrónico</label>
                                        <input type="text" class="form-control" id="register-email"
                                            name="register-email" placeholder="posperu@posperu.com"
                                            aria-describedby="register-email" tabindex="2" />
                                    </div>

                                    <div class="form-group">
                                        <label for="register-password" class="form-label">Contraseña</label>

                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input type="password" class="form-control form-control-merge"
                                                id="register-password" name="register-password"
                                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                                aria-describedby="register-password" tabindex="3" />
                                            <div class="input-group-append">
                                                <span class="input-group-text cursor-pointer"><i
                                                        data-feather="eye"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox"
                                                name="register-privacy-policy" id="register-privacy-policy"
                                                tabindex="4" />
                                            <label class="custom-control-label" for="register-privacy-policy">
                                                Estoy de acuerdo con los <a href="javascript:void(0);">términos y
                                                    póliticas
                                                    de seguridad</a>
                                            </label>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-block" tabindex="5">Registrarse</button>
                                </form>

                                <p class="text-center mt-2">
                                    <span>¿Ya tienes una cuenta?</span>
                                    <a href="login">
                                        <span>Inicia sesión</span>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <!-- /Register v1 -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- <?php require_once('./partials/scripts.php') ?> -->

    <script type="text/javascript" src="script/usuario.js"></script>
    <script type="text/javascript" src="script/helper.js"></script>
</body>
<!-- END: Body-->

</html>