<?php
ob_start();
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login");
} else {
?>

<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-textdirection="ltr">
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
    <title>Home | Yauripet</title>

    <?php require_once('./partials/header.php') ?>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body
    class="vertical-layout vertical-menu-modern content-detached-right-sidebar navbar-floating footer-static menu-collapsed"
    data-open="click" data-menu="vertical-menu-modern" data-col="content-detached-right-sidebar">

    <!-- BEGIN: Header-->
    <?php require_once('./partials/navbar.php') ?>
    <?php require_once('./partials/menu.php') ?>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            EMITIR COMPROBANTE !!
        </div>
    </div>

    <?php require_once('./partials/principal/modals.php') ?>

    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php require_once('./partials/footer.php') ?>
    <script type="text/javascript" src="script/helper.js"></script>
    <script type="text/javascript" src="script/template.js"></script>
    <script type="text/javascript" src="script/emitir_comprobante.js"></script>

</body>
<!-- END: Body-->

</html>
<?php } ?>