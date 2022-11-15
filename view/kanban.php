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
    <title>Kanban - Vuexy - Bootstrap HTML admin template</title>

    <?php require_once('./partials/header.php') ?>

    <!-- <link rel="apple-touch-icon" href="../public/app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../public/app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../public/app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/vendors/css/editors/quill/katex.min.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/vendors/css/jkanban/jkanban.min.css">

    <link rel="stylesheet" type="text/css"
        href="../public/app-assets/vendors/css/editors/quill/monokai-sublime.min.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/vendors/css/editors/quill/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/vendors/css/editors/quill/quill.bubble.css">

    <link rel="stylesheet" type="text/css" href="../public/app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/css/themes/bordered-layout.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/css/themes/semi-dark-layout.css">

    <link rel="stylesheet" type="text/css" href="../public/app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/css/plugins/forms/pickers/form-flat-pickr.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/css/plugins/forms/form-quill-editor.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="../public/app-assets/css/pages/app-kanban.css">

    <link rel="stylesheet" type="text/css" href="../public/assets/css/style.css"> -->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static   menu-collapsed" data-open="click"
    data-menu="vertical-menu-modern" data-col="">

    <?php require_once('./partials/navbar.php') ?>
    <?php require_once('./partials/menu.php') ?>


    <!-- BEGIN: Content-->
    <div class="app-content content kanban-application">
        <!-- BEGIN: INVITACION DE PROYECTO -->
        <ul class="nav bg-danger p-1 mb-3 d-none" id="navbar-invitacion">
            <li class="nav-item d-flex align-items-center">
                <div class="h6 text-light mr-3">Tienes una invitación de
                    <span id="usuario-propietario-invitacion" class="text-danger"></span>
                </div>
                <button class="btn btn-info" id="button-invitacion">Aceptar invitación</button>
            </li>
        </ul>
        <!-- END: INVITACION DE PROYECTO -->

        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Kanban starts -->
                <section class="app-kanban-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <form class="add-new-board">
                                <label class="add-new-btn mb-2" for="add-new-board-input">
                                    <i class="align-middle" data-feather="plus"></i>
                                    <span class="align-middle">Add new</span>
                                </label>
                                <input type="text" class="form-control add-new-board-input mb-50"
                                    placeholder="Add Board Title" id="add-new-board-input" required />
                                <div class="form-group add-new-board-input">
                                    <button class="btn btn-primary btn-sm mr-75">Agregar</button>
                                    <button type="button"
                                        class="btn btn-outline-secondary btn-sm cancel-add-new">Cancelar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Kanban content starts -->
                    <div class="kanban-wrapper"></div>
                    <!-- Kanban content ends -->
                    <!-- Kanban Sidebar starts -->
                    <div class="modal modal-slide-in update-item-sidebar fade">
                        <div class="modal-dialog sidebar-lg">
                            <div class="modal-content p-0">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">×</button>
                                <div class="modal-header mb-1">
                                    <h5 class="modal-title">Update Item</h5>
                                </div>
                                <div class="modal-body flex-grow-1">
                                    <ul class="nav nav-tabs tabs-line">
                                        <li class="nav-item">
                                            <a class="nav-link nav-link-update active" data-toggle="tab"
                                                href="#tab-update">
                                                <i data-feather="edit"></i>
                                                <span class="align-middle">Update</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link nav-link-activity" data-toggle="tab"
                                                href="#tab-activity">
                                                <i data-feather="activity"></i>
                                                <span class="align-middle">Activity</span>
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content mt-2">
                                        <div class="tab-pane tab-pane-update fade show active" id="tab-update"
                                            role="tabpanel">
                                            <form class="update-item-form">
                                                <div class="form-group">
                                                    <label class="form-label" for="title">Title</label>
                                                    <input type="text" id="title" class="form-control"
                                                        placeholder="Enter Title" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="due-date">Due Date</label>
                                                    <input type="text" id="due-date" class="form-control"
                                                        placeholder="Enter Due Date" />
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="label">Label</label>
                                                    <select class="select2 select2-label form-control" id="label">
                                                        <option value="">&nbsp;</option>
                                                        <option data-color="badge-light-success" value="UX">UX
                                                        </option>
                                                        <option data-color="badge-light-warning" value="Images">Images
                                                        </option>
                                                        <option data-color="badge-light-info" value="App">App</option>
                                                        <option data-color="badge-light-danger" value="Code Review">Code
                                                            Review</option>
                                                        <option data-color="badge-light-success" value="Forms">Forms
                                                        </option>
                                                        <option data-color="badge-light-primary" value="Charts & Maps">
                                                            Charts & Maps</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Assigned</label>
                                                    <ul class="assigned pl-0"></ul>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label" for="attachments">Attachments</label>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="attachments" />
                                                        <label class="custom-file-label" for="attachments">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="form-label">Comment</label>
                                                    <div class="comment-editor border-bottom-0"></div>
                                                    <div class="d-flex justify-content-end comment-toolbar">
                                                        <span class="ql-formats mr-0">
                                                            <button class="ql-bold"></button>
                                                            <button class="ql-italic"></button>
                                                            <button class="ql-underline"></button>
                                                            <button class="ql-link"></button>
                                                            <button class="ql-image"></button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="d-flex flex-wrap">
                                                        <button class="btn btn-primary mr-1"
                                                            data-dismiss="modal">Save</button>
                                                        <button type="button" class="btn btn-outline-danger"
                                                            data-dismiss="modal">Delete</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane tab-pane-activity pb-1 fade" id="tab-activity"
                                            role="tabpanel">
                                            <div class="media mb-1">
                                                <div class="avatar bg-light-success my-0 ml-0 mr-50">
                                                    <span class="avatar-content">HJ</span>
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0"><span class="font-weight-bold">Jordan</span> Left
                                                        the board.</p>
                                                    <small class="text-muted">Today 11:00 AM</small>
                                                </div>
                                            </div>
                                            <div class="media mb-1">
                                                <div class="avatar my-0 ml-0 mr-50">
                                                    <img src="../public/app-assets/images/portrait/small/avatar-s-6.jpg"
                                                        alt="Avatar" height="32" />
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0">
                                                        <span class="font-weight-bold">Dianna</span> mentioned
                                                        <span class="font-weight-bold text-primary">@bruce</span> in a
                                                        comment.
                                                    </p>
                                                    <small class="text-muted">Today 10:20 AM</small>
                                                </div>
                                            </div>
                                            <div class="media mb-1">
                                                <div class="avatar my-0 ml-0 mr-50">
                                                    <img src="../public/app-assets/images/portrait/small/avatar-s-2.jpg"
                                                        alt="Avatar" height="32" />
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0">
                                                        <span class="font-weight-bold">Martian</span> added moved Charts
                                                        & Maps task to the done board.
                                                    </p>
                                                    <small class="text-muted">Today 10:00 AM</small>
                                                </div>
                                            </div>
                                            <div class="media mb-1">
                                                <div class="avatar my-0 ml-0 mr-50">
                                                    <img src="../public/app-assets/images/portrait/small/avatar-s-1.jpg"
                                                        alt="Avatar" height="32" />
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0"><span class="font-weight-bold">Barry</span>
                                                        Commented on App review task.</p>
                                                    <small class="text-muted">Today 8:32 AM</small>
                                                </div>
                                            </div>
                                            <div class="media mb-1">
                                                <div class="avatar bg-light-dark my-0 ml-0 mr-50">
                                                    <span class="avatar-content">BW</span>
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0"><span class="font-weight-bold">Bruce</span> was
                                                        assigned task of code review.</p>
                                                    <small class="text-muted">Today 8:30 PM</small>
                                                </div>
                                            </div>
                                            <div class="media mb-1">
                                                <div class="avatar bg-light-danger my-0 ml-0 mr-50">
                                                    <span class="avatar-content">CK</span>
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0">
                                                        <span class="font-weight-bold">Clark</span> assigned task UX
                                                        Research to
                                                        <span class="font-weight-bold text-primary">@martian</span>
                                                    </p>
                                                    <small class="text-muted">Today 8:00 AM</small>
                                                </div>
                                            </div>
                                            <div class="media mb-1">
                                                <div class="avatar my-0 ml-0 mr-50">
                                                    <img src="../public/app-assets/images/portrait/small/avatar-s-4.jpg"
                                                        alt="Avatar" height="32" />
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0">
                                                        <span class="font-weight-bold">Ray</span> Added moved
                                                        <span class="font-weight-bold">Forms & Tables</span> task from
                                                        in progress to done.
                                                    </p>
                                                    <small class="text-muted">Today 7:45 AM</small>
                                                </div>
                                            </div>
                                            <div class="media mb-1">
                                                <div class="avatar my-0 ml-0 mr-50">
                                                    <img src="../public/app-assets/images/portrait/small/avatar-s-1.jpg"
                                                        alt="Avatar" height="32" />
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0">
                                                        <span class="font-weight-bold">Barry</span> Complete all the
                                                        tasks assigned to him.
                                                    </p>
                                                    <small class="text-muted">Today 7:17 AM</small>
                                                </div>
                                            </div>
                                            <div class="media mb-1">
                                                <div class="avatar bg-light-success my-0 ml-0 mr-50">
                                                    <span class="avatar-content">HJ</span>
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0"><span class="font-weight-bold">Jordan</span> added
                                                        task to update new images.</p>
                                                    <small class="text-muted">Today 7:00 AM</small>
                                                </div>
                                            </div>
                                            <div class="media mb-1">
                                                <div class="avatar my-0 ml-0 mr-50">
                                                    <img src="../public/app-assets/images/portrait/small/avatar-s-6.jpg"
                                                        alt="Avatar" height="32" />
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0">
                                                        <span class="font-weight-bold">Dianna</span> moved task
                                                        <span class="font-weight-bold">FAQ UX</span> from in progress to
                                                        done board.
                                                    </p>
                                                    <small class="text-muted">Today 7:00 AM</small>
                                                </div>
                                            </div>
                                            <div class="media mb-1">
                                                <div class="avatar bg-light-danger my-0 ml-0 mr-50">
                                                    <span class="avatar-content">CK</span>
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0">
                                                        <span class="font-weight-bold">Clark</span> added new board with
                                                        name
                                                        <span class="font-weight-bold">Done</span>.
                                                    </p>
                                                    <small class="text-muted">Yesterday 3:00 PM</small>
                                                </div>
                                            </div>
                                            <div class="media align-items-center">
                                                <div class="avatar bg-light-dark my-0 ml-0 mr-50">
                                                    <span class="avatar-content">BW</span>
                                                </div>
                                                <div class="media-body">
                                                    <p class="mb-0"><span class="font-weight-bold">Bruce</span> added
                                                        new task in progress board.</p>
                                                    <small class="text-muted">Yesterday 12:00 PM</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Kanban Sidebar ends -->
                </section>
                <!-- Kanban ends -->
            </div>
        </div>
    </div>

    <?php require_once('./partials/principal/modals.php') ?>

    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <?php require_once('./partials/footer.php') ?>
    <!-- END: Footer-->


    <!-- <script src="../public/app-assets/vendors/js/vendors.min.js"></script>

    <script src="../public/app-assets/vendors/js/jkanban/jkanban.min.js"></script>
    <script src="../public/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../public/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
    <script src="../public/app-assets/vendors/js/editors/quill/katex.min.js"></script>
    <script src="../public/app-assets/vendors/js/editors/quill/highlight.min.js"></script>
    <script src="../public/app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <script src="../public/app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>

    <script src="../public/app-assets/js/core/app-menu.js"></script>
    <script src="../public/app-assets/js/core/app.js"></script>

    <script src="../public/app-assets/js/scripts/pages/app-kanban.js"></script> -->

    <script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
    </script>
    <script type="text/javascript" src="script/kanban.js"></script>
    <script type="text/javascript" src="script/helper.js"></script>

</body>
<!-- END: Body-->

</html>