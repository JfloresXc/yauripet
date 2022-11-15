<!-- ---------------------------------------- MODAL PROYECTO-->
<div class="modal fade text-left" id="modalProyecto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="form-title-proyecto">Agregar proyecto</h4>
                </div>
                <div class="card-body">
                    <form id="form-proyecto" method="POST">
                        <div class="form-group">
                            <label class="form-label" for="nombre-proyecto">Nombre</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather="user"></i></span>
                                </div>
                                <input type="text" class="form-control" id="nombre-proyecto" name="nombre-proyecto"
                                    placeholder="Juan Perez" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-block" for="descripcion-proyecto">Descripción</label>
                            <textarea class="form-control" id="descripcion-proyecto" name="descripcion-proyecto"
                                rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="fechaFin-proyecto">Fecha de finalización</label>
                            <input type="date" class="form-control" name="fechaFin-proyecto" id="fechaFin-proyecto" />
                        </div>
                        <button id="form-button-proyecto" type="submit" class="btn btn-primary">Agregar
                            proyecto</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ---------------------------------------- MODAL PROCESO-->
<div class="modal fade text-left" id="modalProceso" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <h4 id="form-title-proceso" class="card-title">Agregar proceso</h4>
                </div>
                <div class="card-body">
                    <form id="form-proceso" method="POST">
                        <div class="form-group">
                            <label class="form-label" for="nombre-proceso">Nombre</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather="user"></i></span>
                                </div>
                                <input type="text" class="form-control" id="nombre-proceso" name="nombre-proceso"
                                    placeholder="Juan Perez" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-block" for="descripcion-proceso">Descripción</label>
                            <textarea class="form-control" id="descripcion-proceso" name="descripcion-proceso"
                                rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="idProyecto-proceso">Proyectos</label>
                            <select class="form-select form-control" id="idProyecto-proceso" name="idProyecto-proceso">
                            </select>
                        </div>
                        <button id="form-button-proceso" type="submit" class="btn btn-primary">Agregar proceso</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ---------------------------------------- MODAL TAREA-->
<?php
$nameElement = "tarea";
$mayus = "Tarea";
echo '
<div class="modal modal-slide-in sidebar-todo-modal fade" id="modal' . $mayus . '">
    <div class="modal-dialog sidebar-lg">
        <div class="modal-content p-0">
            <form id="form-' . $nameElement . '" class="todo-modal needs-validation" novalidate onsubmit="return false">
                <div class="modal-header align-items-center mb-1">
                    <h5 class="modal-title" id="form-title-' . $nameElement . '"></h5>
                    <div class="todo-item-action d-flex align-items-center justify-content-between ml-auto">
                        <button type="button" class="close font-large-1 font-weight-normal py-0" data-dismiss="modal"
                            aria-label="Close">
                            ×
                        </button>
                    </div>
                </div>
                <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
                    <div class="action-tags">
                        <div class="form-group">
                            <label class="form-label" for="nombre-' . $nameElement . '">Nombre</label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control" id="nombre-' . $nameElement . '" name="nombre-' . $nameElement . '"
                                    placeholder="Nombre" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="fechaFin-' . $nameElement . '" class="form-label">Fecha de finalización</label>
                            <input type="text" class="form-control task-due-date" id="fechaFin-' . $nameElement . '"
                                name="fechaFin-' . $nameElement . '"/>
                        </div>
                        <div class="form-group">
                            <label for="idTag-' . $nameElement . '" class="form-label d-block">Tag</label>
                            <div class="position-relative" data-select2-id="5">
                                <select class="form-control task-tag" id="task-tag"
                                    name="idTag-' . $nameElement . '"  multiple="multiple">
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="idProceso-' . $nameElement . '">Proceso</label>
                            <select class="form-select form-control" id="idProceso-' . $nameElement . '" name="idProceso-' . $nameElement . '">
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="idEstado-' . $nameElement . '">Estado</label>
                            <select class="form-select form-control" id="idEstado-' . $nameElement . '" name="idEstado-' . $nameElement . '">
                            </select>
                        </div>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="crucial-' . $nameElement . '"
                                name="crucial-' . $nameElement . '">
                            <label class="custom-control-label" for="crucial-' . $nameElement . '">Importante</label>
                        </div>
                        <div class="custom-control custom-checkbox mb-1">
                            <input type="checkbox" class="custom-control-input" id="listo-' . $nameElement . '" name="listo-' . $nameElement . '">
                            <label class="custom-control-label" for="listo-' . $nameElement . '">Completado</label>
                        </div>
                    </div>
                    <div class="form-group my-1">
                        <button type="submit"  id="form-button-' . $nameElement . '"
                        class="btn btn-primary ">
                            Add
                        </button>
                        <button type="button" class="btn btn-outline-danger update-btn d-none" data-dismiss="modal"
                            onclick="clickButtonEliminarDeTarea()"
                        >
                            Eliminar de tareas
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
'
?>

<!-- ---------------------------------------- MODAL BLOQUE-->
<div class="modal fade text-left" id="modalSingleBloque" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content" id="modal-content-bloque">

        </div>
    </div>
</div>

<!-- ---------------------------------------- MODAL EQUIPO-->
<div class="modal fade text-left" id="modalEquipo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Enviar invitación de proyecto</h4>
                </div>
                <div class="card-body">
                    <form id="form-new-equipo" method="POST">
                        <div class="form-group">
                            <label class="form-label" for="idProyecto-invitacion">Proyecto</label>
                            <select class="form-select form-control" id="idProyecto-invitacion"
                                name="idProyecto-invitacion">
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="email-destino-invitacion">Correo electrónico</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i data-feather="user"></i></span>
                                </div>
                                <input type="email" class="form-control" id="email-destino-invitacion"
                                    name="email-destino-invitacion" placeholder="posperu@posperu.com" required />
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar correo</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ---------------------------------------- MODAL EQUIPO EN BLOQUE-->
<div class="modal fade text-left" id="modalEquipoEnBloque" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Designar usuario a bloque</h4>
                </div>
                <div class="card-body">
                    <form id="form-new-usuario-bloque" method="POST">
                        <div class="form-group">
                            <label class="form-label" for="idUsuario-bloque">Usuarios</label>
                            <select class="form-select form-control" id="idUsuario-bloque" name="idUsuario-bloque">
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Designar usuario</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ---------------------------------------- MODAL AGREGAR - EDITAR ITEM OPTIONS-->
<div class="modal fade" id="modalItemOptions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <h4 id="" class="title">Editar Item</h4>
                    </div>
                    <div class="card-body">
                        <form id="form-itemOptions">
                            <div class="mb-1" data-select2-id="6">
                                <label for="idManual-item" class="form-label d-block">Manual</label>
                                <div class="position-relative" data-select2-id="5">
                                    <select class="form-select task-tag select2-hidden-accessible" id="idManual-item"
                                        name="idManual-item" multiple data-select2-id="idManual-item" tabindex="-1"
                                        aria-hidden="true">
                                    </select>
                                </div>
                            </div>
                            <div class="custom-control custom-checkbox mb-1">
                                <input type="checkbox" class="custom-control-input" id="tarea-item" name="tarea-item">
                                <label class="custom-control-label" for="tarea-item">Tarea</label>
                            </div>
                            <div class="custom-control custom-checkbox mb-1">
                                <input type="checkbox" class="custom-control-input" id="listo-item" name="listo-item">
                                <label class="custom-control-label" for="listo-item">Listo</label>
                            </div>
                            <button id="" class="btn btn-primary form-control">Editar
                                item</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ---------------------------------------- MODAL AGREGAR - EDITAR ITEM-->
<div class="modal fade" id="modalItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="card">
                    <div class="card-header">
                        <h4 id="form-title-item" class="title">Agregar Item</h4>
                    </div>
                    <div class="card-body">
                        <form id="form-item">
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