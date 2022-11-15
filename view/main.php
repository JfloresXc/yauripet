<?php
ob_start();
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: login");
} else {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Posperu | Trello</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">


    <link rel="shortcut icon" href="../dist/img/icon.png">
    <link rel="stylesheet" href="../view/css/index.css">

</head>

<body>
    <!-- <?php echo "<h1 class='text-light'>" . $_SESSION["usuario"] . " </h1>" ?> -->
    <!-- <form method="post" id="summer">
        <textarea id="summernote" name="editordata"></textarea>
        <button class=" btn btn-danger" type="submit">Mostrar codigo</button>
    </form> -->
    <section class="content">
        <nav id="navbar-invitacion" class="navbar navbar-expand navbar-dark navbar-dark d-none">
            <ul class="navbar-nav">
                <li class="nav-item d-flex justify-content-center align-items-center">
                    <div class="h6 text-light mr-3">Tienes una invitación de
                        <span id="usuario-propietario-invitacion" class="text-danger"></span>
                    </div>
                    <button class="btn btn-info" id="button-invitacion">Aceptar invitación</button>
                </li>
            </ul>
        </nav>
        <nav class="navbar navbar-expand navbar-primary navbar-dark">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-comments"></i>
                        Modos
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Modo manual
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Modo calendario
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <div class="media">
                                <div class="media-body">
                                    <h3 class="dropdown-item-title">
                                        Modo canvan
                                        <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                                    </h3>
                                </div>
                            </div>
                        </a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="ml-5 nav-item">
                    <button class="btn btn-danger" id="button-logout">Cerrar sesión</button>
                </li>
            </ul>
        </nav>
        <div class="container">
            <div class="row mt-5">
                <div class="col-lg-3">
                    <div class="form-group">
                        <select class="form-control select2" id="idProyecto">
                        </select>
                    </div>
                </div>
                <div class="col-lg-1">
                    <button type="button" class="btn btn-warning mb-3 col-lg-6" data-toggle="modal"
                        data-target="#modalProyecto">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <div class="col-lg-3 row">
                    <div class="equipo__usuarios">
                    </div>
                    <button type="button" class="btn btn-warning equipo__add" data-toggle="modal"
                        data-target="#modalObtenerInvitacion">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>

                <!-- <div class="col-lg-2">
                    <div class="form-group">
                        <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"
                            style="width: 100%;">
                            <option>Modo 1</option>
                            <option>Modo 2</option>
                            <option>Modo 3</option>
                        </select>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <select class="form-control select2 select2-danger" id="exampleSelectBorder">
                            <option>Datos 1</option>
                            <option>Datos 2</option>
                            <option>Datos 3</option>
                        </select>
                    </div>
                </div> -->
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container">
            <div class="row mt-2">
                <div class="proceso col-lg-2  mb-3">
                    <div class="card w-100 m-0">
                        <div class="card-body" style="margin: 0; width: 100%;">
                            <p id="descripcionProyecto">Descripcion</p>
                            <h3 id="nombreProyecto" style="margin: 0px;">Titulo Proyecto</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2  mb-3">
                    <div class="card" style="height: 100%;">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary form-control mb-3" data-toggle="modal"
                                data-target="#modalProceso">
                                +
                            </button>
                            <div class="procesos" id="listaProcesos">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title" id="tituloCardProceso">Titulo Proceso (Descripcion)</h4>
                        </div>
                        <div class="card-body">
                            <button type="button" id="button-modal-item" class=" btn btn-primary external-even"
                                data-toggle="modal" data-target="#modalNewItem">
                                <i class="fas fa-text-height"></i>
                                Agregar Item
                            </button>
                            <!-- <h4 class="card-title" id="tituloCardProceso">Titulo Proceso (Descripcion)</h4> -->
                        </div>
                    </div>
                    <!-- <div class="card"> -->
                    <!-- <div class="card-header"> -->
                    <div class="row" style="display: flex; gap: 10px;">

                        <!-- </div> -->
                        <!-- </div> -->
                    </div>
                    <?php require_once("./partials/tabs.php") ?>

                </div>
            </div>
        </div>
        </div>


        <!-- ---------------------------------------- MODAL PROYECTO-->
        <div class="modal fade" id="modalProyecto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar proyecto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form id="form-new-proyecto">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="nombre-proyecto"
                                            placeholder="Nombre">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="descripcion-proyecto"
                                            placeholder="Descripcion">
                                    </div>
                                    <div class="mb-3">
                                        <input type="date" class="form-control" name="fechaIni-proyecto"
                                            placeholder="Fecha inicial">
                                    </div>
                                    <div class="mb-3">
                                        <input type="date" class="form-control" name="fechaFin-proyecto"
                                            placeholder="Fecha fin">
                                    </div>
                                    <div class="form-check mb-3">
                                        <input class="form-check-input" type="checkbox" name="cerrado-proyecto"
                                            id="flexRadioDisabled">
                                        <label class="form-check-label" for="flexRadioDisabled">
                                            Cerrado
                                        </label>
                                    </div>
                                    <button class="btn btn-primary form-control">Agregar proyecto</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ---------------------------------------- MODAL PROCESO-->
        <div class="modal fade" id="modalProceso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar proceso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form id="form-new-proceso">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="nombre-proceso"
                                            placeholder="Nombre">
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="descripcion-proceso"
                                            placeholder="Descripcion">
                                    </div>
                                    <div class="mb-3">
                                        <select class="form-control" id="idProyecto-proceso" name="idProyecto-proceso">

                                        </select>
                                    </div>

                                    <button class="btn btn-primary form-control">Agregar proceso</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ---------------------------------------- MODAL AGREGAR - EDITAR ITEM-->
        <div class="modal fade" id="modalNewItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <!-- <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar item texto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div> -->
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form id="form-new-item">
                                    <div class="mb-3">
                                        <select class="form-control" id="idBloque-item" name="idBloque-item">
                                        </select>
                                    </div>

                                    <!-- <div class="mb-3">
                                        <input type="number" name="orden-item" class="form-control" id="orden-item"
                                            placeholder="Orden">
                                    </div> -->
                                    <div class="mb-3">
                                        <textarea id="contenido-item" name="contenido-item"></textarea>
                                    </div>
                                    <button id="form-button-item" class="btn btn-primary form-control">Agregar
                                        item</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ---------------------------------------- MODAL AGREGAR ITEM TEXTO-->
        <!-- <div class="modal fade" id="modalNewItemTexto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar item texto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form id="form-new-item-texto">
                                    <div class="mb-3">
                                        <select class="form-control" id="idBloque-item-texto"
                                            name="idBloque-item-texto">
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="contenido-item-texto"
                                            id="contenido-item-texto" placeholder="Contenido">
                                    </div>
                                    <div class="mb-3">
                                        <input type="number" name="orden-item-texto" class="form-control"
                                            id="orden-item-texto" placeholder="Orden">
                                    </div>

                                    <button id="form-button-item-texto" class="btn btn-primary form-control">Agregar
                                        item</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->

        <!-- ---------------------------------------- MODAL AGREGAR - EDITAR ITEM IMAGEN-->
        <div class="modal fade" id="modalNewItemImagen" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Agregar item imagen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form class="form" id="form-new-imagen" role="form" enctype="multipart/form-data">
                                    <div class="mb-3">
                                        <select class="form-control" id="idBloque-item-imagen"
                                            name="idBloque-item-imagen">
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <input type="file" class="form-control" name="imagen" id="imagen">
                                    </div>
                                    <div class="mb-3">
                                        <input type="number" name="orden-item-imagen" class="form-control"
                                            placeholder="Orden">
                                    </div>

                                    <button id="form-button-item-imagen" class="btn btn-primary form-control">Agregar
                                        item</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ---------------------------------------- MODAL OBTENER ENLACE INVITACION -->
        <div class="modal fade" id="modalObtenerInvitacion" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Enviar invitación de proyecto</h5>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <form class="form" id="form-new-invitacion">
                                    <div class="mb-3">
                                        <select class="form-control" id="idProyecto-invitacion"
                                            name="idProyecto-invitacion">
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <input type="text" class="form-control" name="email-destino-invitacion"
                                            id="email-destino-invitacion" placeholder="Correo a invitar">
                                    </div>

                                    <button id="form-button-item-imagen" class="btn btn-primary form-control">Enviar a
                                        correo</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous">
    </script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script type="text/javascript" src="script/principal.js"></script>

    <script>
    $(document).ready(function() {
        $('#contenido-item').summernote({
            placeholder: 'Hello Bootstrap 4',
            tabsize: 2,
            height: 300,
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: true
        });
    })
    </script>
</body>

</html>
<?php } ?>