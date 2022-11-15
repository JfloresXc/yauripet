<!DOCTYPE html>
<html class="loading dark-layout" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui" />
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities." />
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app" />
    <meta name="author" content="PIXINVENT" />
    <title>Tareas | Posperu</title>

    <?php require_once('./partials/header.php') ?>
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern content-left-sidebar navbar-floating footer-static menu-collapsed"
    data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->

    <?php require_once('./partials/navbar.php') ?>
    <?php require_once('./partials/tareas/menu.php') ?>

    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content todo-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12 d-lg-flex">
                            <h2 class="mr-3 titulo-editable" id="titulo-proyecto"
                                onclick="clickButtonVerModalProyecto(true)">loading...</h2>
                            <div class="avatar-group" id="equipo-usuarios"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="project__element-proyecto content-detached content-left">
                <div class="blog-detail-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <!-- <div class="content-header row">
                                <div class="content-header-left col-12 mb-2">
                                    <div class="row breadcrumbs-top">
                                        <div class="col-12 d-flex justify-content-between">
                                            <h6 class="titulo-editable float-left mb-0" id="titulo-proceso"
                                                onclick="clickButtonVerModalProceso(true)">loading...
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="project__element-proceso" id="listaBloques">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- -------------------------------------------------------------------------------------------------- -->
        <div class="content-area-wrapper container-xxl p-0">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="sidebar-content todo-sidebar">
                        <div class="todo-app-menu">
                            <div class="add-task">
                                <button type="button" id="button-add-tarea" class="btn btn-primary btn-block"
                                    data-target="#new-task-modal" onclick="clickButtonVerModalTarea()">
                                    Agregar tarea
                                </button>
                            </div>
                            <div class="sidebar-menu-list">
                                <div class="list-group list-group-filters">
                                    <a href="javascript:void(0)" onclick="clickButtonFiltrarTodos()"
                                        class="list-group-item list-group-item-action active">
                                        <i data-feather="mail" class="font-medium-3 mr-50"></i>
                                        <span class="align-middle">Mis tareas</span>
                                    </a>
                                    <a href="javascript:void(0)" onclick="clickButtonFiltrarImportantes()"
                                        class="list-group-item list-group-item-action">
                                        <i data-feather="star" class="font-medium-3 mr-50"></i>
                                        <span class="align-middle">Importantes</span>
                                    </a>
                                    <a href="javascript:void(0)" onclick="clickButtonFiltrarCompletadas()"
                                        class="list-group-item list-group-item-action">
                                        <i data-feather="check" class="font-medium-3 mr-50"></i>
                                        <span class="align-middle">Completadas</span>
                                    </a>
                                </div>
                                <div class="mt-3 px-2 d-flex justify-content-between">
                                    <h6 class="section-label mb-1">Tags</h6>
                                </div>
                                <div class="list-group list-group-labels" id="listaTags">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-right">
                <div class="content-wrapper container-xxl p-0">
                    <div class="content-header row"></div>
                    <div class="content-body">
                        <div class="body-content-overlay"></div>
                        <div class="todo-app-list">
                            <!-- Todo search starts -->
                            <div class="app-fixed-search d-flex align-items-center">
                                <div class="sidebar-toggle d-block d-lg-none ml-1">
                                    <i data-feather="menu" class="font-medium-5"></i>
                                </div>
                                <div class="d-flex align-content-center justify-content-between w-100">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i data-feather="search"
                                                    class="text-muted"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="todo-search"
                                            placeholder="Buscar tarea" aria-label="Search..."
                                            aria-describedby="todo-search" />
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle hide-arrow mr-1"
                                        id="todoActions" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i data-feather="more-vertical" class="font-medium-2 text-body"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="todoActions">
                                        <a class="dropdown-item sort-asc" href="javascript:void(0)">Sort A - Z</a>
                                        <a class="dropdown-item sort-desc" href="javascript:void(0)">Sort Z - A</a>
                                    </div>
                                </div>
                            </div>
                            <!-- Todo search ends -->

                            <!-- Todo List starts -->
                            <div class="todo-task-list-wrapper list-group">
                                <ul class="todo-task-list media-list listaTareas" id="todo-task-list">
                                </ul>
                                <div class="no-results">
                                    <h5>Tarea no encontrada</h5>
                                </div>
                            </div>
                            <!-- Todo List ends -->
                        </div>

                        <!-- Right Sidebar starts -->

                        <!-- Right Sidebar ends -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once('./partials/tareas/modals.php') ?>

    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <?php require_once('./partials/footer.php') ?>
    <script>
    $(document).ready(function() {
        $('#contenido-item').summernote({
            placeholder: 'Escribe tu contenido',
            tabsize: 2,
            height: 300,
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: true
        });
    })
    </script>
    <script type="text/javascript" src="script/helper.js"></script>
    <script type="text/javascript" src="script/template.js"></script>
    <script type="text/javascript" src="script/tareas.js"></script>
</body>
<!-- END: Body-->

</html>