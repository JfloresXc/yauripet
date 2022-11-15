const RUTA_CONTROLLER = "../controller/tarea.php?op=";

const RUTA_GET_PROYECTOS = RUTA_CONTROLLER + "listarProyectos";
const RUTA_GET_PROYECTO = RUTA_CONTROLLER + "changeProyecto";
const RUTA_ADD_PROYECTO = RUTA_CONTROLLER + "agregarProyecto";
const RUTA_EDIT_PROYECTO = RUTA_CONTROLLER + "editarProyecto";
const RUTA_GET_ULTIMO_PROYECTO =
  RUTA_CONTROLLER + "mostrarUltimoProyecto";
const RUTA_ADD_INVITACION = RUTA_CONTROLLER + "agregarInvitacion";
const RUTA_GET_PROCESOS = RUTA_CONTROLLER + "listarProcesos";
const RUTA_ADD_PROCESO = RUTA_CONTROLLER + "agregarProceso";
const RUTA_EDIT_PROCESO = RUTA_CONTROLLER + "editarProceso";

const RUTA_GET_TAREAS = RUTA_CONTROLLER + "listarTareas";
const RUTA_GET_TAREA = RUTA_CONTROLLER + "mostrarTarea";

const RUTA_GET_BLOQUES = RUTA_CONTROLLER + "listarBloques";
const RUTA_GET_BLOQUES_USUARIOS_PROYECTO =
  RUTA_CONTROLLER + "listarBloquesUsuariosDeProyecto";
const RUTA_GET_TAGS_TAREAS_PROYECTO =
  RUTA_CONTROLLER + "listarTagsTareasDeProyecto";
const RUTA_ADD_USUARIO_BLOQUE =
  RUTA_CONTROLLER + "agregarUsuarioBloque";
const RUTA_GET_BLOQUES_TAGS = RUTA_CONTROLLER + "listarBloquesTags";
const RUTA_ADD_BLOQUE_TAG = RUTA_CONTROLLER + "agregarBloqueTag";
const RUTA_DELETE_BLOQUE_TAG = RUTA_CONTROLLER + "eliminarBloqueTag";
const RUTA_GET_ULTIMO_BLOQUE =
  RUTA_CONTROLLER + "mostrarUltimoBloque";
const RUTA_ADD_BLOQUE = RUTA_CONTROLLER + "agregarBloque";
const RUTA_EDIT_BLOQUE = RUTA_CONTROLLER + "editarBloque";
const RUTA_EDIT_TAREA_BLOQUE =
  RUTA_CONTROLLER + "editarTareaEnBloque";
const RUTA_EDIT_LISTO_BLOQUE =
  RUTA_CONTROLLER + "editarListoEnBloque";
const RUTA_VERIFICAR_USUARIO_BLOQUE =
  RUTA_CONTROLLER + "verificarUsuarioBloque";

const RUTA_GET_TAGS = RUTA_CONTROLLER + "listarTags";
const RUTA_GET_ESTADOS = RUTA_CONTROLLER + "listarEstados";
const RUTA_GET_ITEMS = RUTA_CONTROLLER + "listarItems";
const RUTA_GET_ITEM = RUTA_CONTROLLER + "mostrarItem";
const RUTA_ADD_ITEM = RUTA_CONTROLLER + "agregarItem";
const RUTA_GET_ULTIMO_ITEM = RUTA_CONTROLLER + "mostrarUltimoItem";
const RUTA_EDIT_ITEM = RUTA_CONTROLLER + "editarItem";
const RUTA_ELIMINAR_ITEM = RUTA_CONTROLLER + "eliminarItem";
const RUTA_EDIT_ITEM_OPTIONS = RUTA_CONTROLLER + "editarItemOptions";
const RUTA_ADD_ITEM_MANUAL = RUTA_CONTROLLER + "agregarItemManual";
const RUTA_DELETE_ITEM_MANUAL =
  RUTA_CONTROLLER + "eliminarItemManual";
const RUTA_GET_MANUALES = RUTA_CONTROLLER + "listarManuales";
const RUTA_GET_MANUALES_ITEMS_PROYECTO =
  RUTA_CONTROLLER + "listarManualesItemsDeProyecto";
const RUTA_ADD_EQUIPO = RUTA_CONTROLLER + "agregarEquipo";
const RUTA_VERIFICAR_USUARIO_EQUIPO =
  RUTA_CONTROLLER + "verificarUsuarioEquipo";
const RUTA_LOGOUT = RUTA_CONTROLLER + "logout";
const RUTA_GET_USUARIO = RUTA_CONTROLLER + "mostrarUsuario";
const RUTA_SESION_USUARIO = RUTA_CONTROLLER + "mostrarSesionUsuario";
const RUTA_SESSION_INVITACION =
  RUTA_CONTROLLER + "mostrarSesionInvitacion";
const RUTA_VERIFICAR_INVITACION =
  RUTA_CONTROLLER + "verificarInvitacion";
const RUTA_ACEPTAR_INVITACION = RUTA_CONTROLLER + "aceptarInvitacion";
const RUTA_GET_USUARIOS_PROYECTO =
  RUTA_CONTROLLER + "listarUsuariosPorProyecto";
//
const RUTA_GET_TAG_PROYECTO =
  RUTA_CONTROLLER + "listarTagPorProyecto";
//
const RUTA_ENVIAR_EMAIL =
  "../controller/enviar-correo.php?op=enviarMail";

let USUARIO = "No hay usuario";
let ID_USUARIO;
let ID_PROYECTO;
let ID_BLOQUE;
let ID_PROYECTO_INVITACION;
let PROYECTOS_USER = [];
let PROYECTO_OBJETO;
let ID_PROCESO;
let PROCESO_OBJETO;
let PROCESOS_USER = [];
let ID_TAREA;
let BLOQUES_USER = [];
let ID_ITEM_BLOQUE;
let TAREAS = [];
let ITEMS_USER = [];
let USUARIOS_BLOQUE_USER = [];
let ID_ITEM;
let ID_ITEM_ULTIMO;
let CODIGO_INVITACION;
let USUARIOS_PROYECTO = [];
let TAGS_PROYECTO = [];
let TAGS = [];
let MANUALES_PROYECTO = [];
let MANUALES = [];
let FILTROS = ["no listo", "listo", "crucial"];
let FILTRO = FILTROS[0];

let MENSAJE_SIN_PROYECTOS = "No hay proyectos aún";

// ----------------------------------------- INICIACIÓN
function init() {
  //  Renderizados
  renderInitial();

  //   Eventos
  clickButtonInvitacion();
  clickButtonOptionsTarea();
  submitAddOrEditProyecto();
  submitNewInvitacion();
  submitAddOrEditProceso();
  submitAddOrEditTarea();
  submitNewUsuarioEnBloque();
  submitAddOrEditItem();
  submitAddOrEditItemOptions();
}

// ----------------------------------------- RENDERIZADOS
function renderInitial() {
  $.post(RUTA_SESION_USUARIO, (response) => {
    const data = JSON.parse(response);
    const responseUser = data[0];
    USUARIO = responseUser;

    renderUser({ nombre: data[1], username: responseUser });

    $.post(
      RUTA_GET_PROYECTOS,
      { usuario: responseUser },
      (responseProjects) => {
        const proyectos = JSON.parse(responseProjects);
        PROYECTOS_USER = proyectos;

        ID_PROYECTO = proyectos[0]?.id;
        const idProyecto = proyectos[0]?.id;

        if (!idProyecto) {
          $("#titulo-proyecto").html(MENSAJE_SIN_PROYECTOS);
          $(".project__element-proyecto").html("");
          return;
        }

        renderProyectos(proyectos);
        renderProyecto({ idProyecto });
        postUsuariosPorProyecto({ idProyecto });
        postProcesos({ idProyecto });

        postEstados();
        postTags();
      }
    );

    $.post(
      RUTA_GET_USUARIO,
      { usuario: responseUser },
      (responseUser) => {
        responseUser = JSON.parse(responseUser);
        if (responseUser) {
          ID_USUARIO = responseUser.id;
        }
      }
    );

    $.post(RUTA_SESSION_INVITACION, (responseInvitacion) => {
      if (responseInvitacion !== "No hay invitacion") {
        verificarInvitacion({ codigoInvitacion: responseInvitacion });
      }
    });

    $.post(RUTA_GET_MANUALES, (responseManuales) => {
      responseManuales = JSON.parse(responseManuales);
      if (responseManuales) {
        MANUALES = responseManuales;
        renderManuales(responseManuales);
      }
    });
  });
}

function renderUser({ nombre, username }) {
  $("#username-usuario").text(username);
  $("#nombre-usuario").text(nombre);
}

function renderProyectos(proyectos = []) {
  const listaProyectos = document.getElementById("listaProyectos");
  const cantidad1 = document.getElementById("cantidad-proyecto-1");
  const cantidad2 = document.getElementById("cantidad-proyecto-2");
  const listaProyectosEnProcesos = document.getElementById(
    "idProyecto-proceso"
  );
  const listaProyectosEnInvitacion = document.getElementById(
    "idProyecto-invitacion"
  );

  cantidad1.innerHTML = proyectos.length;
  cantidad2.innerHTML = proyectos.length;
  listaProyectos.innerHTML = "";
  listaProyectosEnProcesos.innerHTML = "";
  listaProyectosEnInvitacion.innerHTML = "";

  proyectos?.map((proyectoKey) => {
    const { proyecto, descripcion, id } = proyectoKey;

    listaProyectos.innerHTML += `
        <div class="media align-items-center" onclick="clickButtonVerProyecto(${id})">
            <div class="media-body">
                <!-- <i data-feather='settings'></i> -->
                <div class="media-heading w-100">
                    <h6 class="cart-item-title">
                        <span class="text-body">
                          ${proyecto}
                        </span>
                    </h6>
                    <span class="cart-item-by">${descripcion}</span>
                </div>
                <a><i class="fa-solid fa-gear"></i></a>
            </div>
        </div>
    `;

    listaProyectosEnProcesos.innerHTML += `<option value=${id}>${proyecto}</option>`;
    listaProyectosEnInvitacion.innerHTML += `<option value=${id}>${proyecto}</option>`;
  });
}

function renderProyecto({ idProyecto }) {
  $.post(RUTA_GET_PROYECTO, { idProyecto }, (data) => {
    data = JSON.parse(data);
    PROYECTO_OBJETO = data;
    $("#titulo-proyecto").html("Proyecto " + data.proyecto);
  });
}

function renderUsuariosDeProyecto(usuarios = []) {
  const listaUsuarios = document.getElementById("equipo-usuarios");
  const equipoEnBloque = document.getElementById("idUsuario-bloque");

  listaUsuarios.innerHTML = "";
  equipoEnBloque.innerHTML = "";

  usuarios?.forEach((usuarioKey) => {
    const { nombre, id } = usuarioKey;
    const letra1 = `${nombre}`[0].toUpperCase();

    listaUsuarios.innerHTML += `
          <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top"
              data-original-title="${nombre}" title="${nombre}" class="avatar pull-up" id="user-${id}">
              <img src="../public/app-assets/images/portrait/small/avatar-s-20.jpg" alt="Avatar" height="32"
                  width="32" />
          </div>
        `;

    equipoEnBloque.innerHTML += `
        <option value=${id}>${nombre}</option>
      `;
  });

  listaUsuarios.innerHTML += `
    <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top"
          class="avatar pull-up">
          <button type="button" onclick="clickButtonVerModalEquipo()"
          class="btn btn-icon btn-icon rounded-circle btn-warning waves-effect waves-float waves-light">
          <i class="fa-solid fa-plus"></i>
      </button>
    </div>
  `;
}

function renderInvitacion({
  isInvitado = false,
  propietario = "No hay propietario",
}) {
  const propietarioElement = document.getElementById(
    "usuario-propietario-invitacion"
  );
  propietarioElement.innerHTML = propietario;

  if (isInvitado) $("#navbar-invitacion").addClass("d-block");
  else $("#navbar-invitacion").removeClass("d-block");
}

function renderProcesos(procesos = []) {
  const cantidadProcesos = document.getElementById(
    "cantidad-proceso"
  );
  const listaProcesosEnTarea =
    document.getElementById("idProceso-tarea");

  listaProcesosEnTarea.innerHTML = "";

  procesos?.map((procesoKey) => {
    const { proceso, id } = procesoKey;
    listaProcesosEnTarea.innerHTML += `
      <option value=${id}>${proceso}</option>
    `;
  });
}

function renderProceso(idProceso) {
  $.post(
    "../controller/principal.php?op=mostrarProceso",
    { idProceso },
    function (data) {
      // $(".proceso__button").removeClass("active");
      // $("#proceso-" + idProceso).addClass("active");

      data = JSON.parse(data);
      ID_PROCESO = idProceso;
      PROCESO_OBJETO = data;
      // $("#titulo-proceso").html(data.proceso);
      postTareas({ idProyecto: ID_PROYECTO });
    }
  );
}

function renderTareas(tareas = [], listo = false) {
  const listaTareas = document.querySelector(".listaTareas");

  listaTareas.innerHTML = "";

  tareas?.map((bloqueKey) => {
    const { bloque, id, fechafin } = bloqueKey;

    listaTareas.innerHTML += `
      <li class="todo-item completed" id="tarea-${id}">
        <div class="todo-title-wrapper">
            <div class="todo-title-area">
                <i data-feather="more-vertical" class="drag-icon"></i>
                <div class="title-wrapper">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input "
                            id="customCheck${id}"/>
                        <label class="custom-control-label" for="customCheck${id}"></label>
                    </div>
                    <span class="todo-title">
                        ${bloque}
                    </span>
                </div>
            </div>
            <div class="todo-item-action">
                <div class="badge-wrapper mr-1" id="tags-tarea-${id}">

                </div>
                <small class="text-nowrap text-muted mr-1">${fechafin}</small>
                <div class="avatar">
                    <img src="../public/app-assets/images/portrait/small/avatar-s-5.jpg"
                        alt="user-avatar" height="32" width="32" />
                </div>
            </div>
        </div>
      </li>
  `;
  });

  tareas?.forEach(({ listo, id }) => {
    if (listo == "t") {
      $(`#customCheck${id}`).prop("checked", true);
    }
  });
}

function renderBloque(bloqueKey) {
  const { bloque, id } = bloqueKey;
  const bloqueElement = document.getElementById(
    `modal-content-bloque`
  );

  bloqueElement.innerHTML = "";
  bloqueElement.innerHTML += `
      <div class="card">
          <div class="card-header" >
              <h4 class="mr-3 titulo-editable" id="titulo-bloque">${bloque}</h4>
              <div class="avatar-group" id="bloque-usuario-${id}">
              
              </div>
              <div style="display: flex; gap: 2em">
                <button 
                  type="button" 
                  class="btn btn-icon btn-info waves-effect waves-float waves-light "
                  onclick="clickButtonVerModalItem({idBloque: ${id}})"
                >
                  <i class="fa-solid fa-circle-plus"></i>
                </button>
              </div>
          </div>
          <div class="card-content collapse show card__content-${id}" >
              <div class="card-body" id="bloque-${id}">
                
            </div>
          </div>
      </div>
    `;

  $("#modalSingleBloque").modal("show");
}

function renderTags(tags = []) {
  const listaTags = document.getElementById("listaTags");
  const listaTagsEnBloque =
    document.getElementsByName("idTag-tarea")[0];

  listaTagsEnBloque.innerHTML = "";
  listaTags.innerHTML = "";

  tags?.map((tagKey) => {
    const { tag, id } = tagKey;
    listaTags.innerHTML += `
      <a onclick="clickButtonFiltrarPorTag('${tag}')"
          class="list-group-item list-group-item-action d-flex align-items-center">
          <span class="bullet bullet-sm mr-1"></span>${tag}
      </a>
    `;

    listaTagsEnBloque.innerHTML += `
      <option value="${id}" selected>${tag}</option>
    `;
  });

  const colors = ["primary", "success", "warning", "danger", "info"];
  document.querySelectorAll(".bullet").forEach((e, index) => {
    e.classList.add("bullet-" + colors[index]);
  });
}

function renderEstados(estados = []) {
  const listaEstadosEnTarea =
    document.getElementById("idEstado-tarea");
  listaEstadosEnTarea.innerHTML = "";

  estados?.map((estadoKey) => {
    const { estado, id } = estadoKey;
    listaEstadosEnTarea.innerHTML += `
      <option value=${id}>${estado}</option>
    `;
  });
}

function renderManuales(manuales = []) {
  const listaManualesEnItem =
    document.getElementById("idManual-item");

  listaManualesEnItem.innerHTML = "";

  manuales?.forEach((manualKey) => {
    const { manual, id } = manualKey;
    listaManualesEnItem.innerHTML += `
      <option value=${id}>${manual}</option>
    `;
  });
}

function renderTagsEnTarea(tagsTareas = [], tareas = []) {
  tareas.forEach((tareaKey) => {
    const { id } = tareaKey;
    const listTags = document.getElementById("tags-tarea-" + id);

    listTags.innerHTML = "";

    const tags = tagsTareas?.filter((tareaTagKey) => {
      return id == tareaTagKey?.id;
    });

    const getColor = (tag) => {
      switch (tag) {
        case "Bug":
          return "primary";
        case "Help":
          return "success";
        case "Update":
          return "warning";
        case "Test":
          return "danger";
        case "Doc":
          return "info";
      }
    };

    tags?.forEach(({ tag }) => {
      listTags.innerHTML += `
      <div class="badge badge-pill badge-light-${getColor(tag)}">
          ${tag}
      </div>
    `;
    });
  });
}

function renderItems(items = [], bloqueKey) {
  const listaItems = document.getElementById(
    "bloque-" + bloqueKey?.id
  );
  listaItems.innerHTML = "";

  const itemsFilter = items.filter((itemKey) => {
    return itemKey?.bloque == bloqueKey?.id;
  });

  itemsFilter.forEach((itemKey) => {
    const { tipo, contenido, id } = itemKey;

    let menuOptions = `
      <div class="dropstart-center">
        <button class="btn btn-icon rounded-circle waves-effect" id="menu1" type="button" data-toggle="dropdown">
        <i class="fa-solid fa-ellipsis-vertical"></i>
        </button>
        <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
          <li class="dropdown-item text-success" onclick="clickButtonVerModalItemManual({idItem: ${id}})">
            <i class="fa-solid fa-pen"></i>
            <span class="align-middle ms-25">Editar</span>
          </li>
          <li class="dropdown-item text-primary" onclick="clickButtonVerModalItem({idItem: ${id}})">
            <i class="fas fa-edit"></i>
            <span class="align-middle ms-25">Contenido</span>
          </li>
          <li class="dropdown-item text-danger" onclick="clickButtonEliminarItem(${id})">
            <i class="fa-sharp fa-solid fa-trash"></i>
            <span class="align-middle ms-25">Eliminar</span>
          </li>
        </ul>
      </div>
      `;

    if (tipo == "1") {
      listaItems.innerHTML += `
        <div class="media item">
          <div class="media-body d-flex ">
          ${menuOptions}
          ${contenido}
          </div>
        </div>
        <hr class="my-2" />
      `;
    }
  });
}

function renderUsuariosEnBloque(usuariosBloques = [], bloqueKey) {
  const { id } = bloqueKey;
  const listaUsuarios = document.getElementById(
    "bloque-usuario-" + id
  );

  listaUsuarios.innerHTML = "";

  const usuarios = usuariosBloques?.filter((bloqueUserKey) => {
    return id == bloqueUserKey?.id;
  });

  usuarios?.forEach(({ nombre }) => {
    listaUsuarios.innerHTML += `
      <div data-toggle="tooltip" data-popup="tooltip-custom"
          data-placement="bottom" data-original-title="${nombre}"
          title="${nombre}"
          class="avatar pull-up ">
          <img src="../public/app-assets/images/portrait/small/avatar-s-9.jpg"
              alt="Avatar" width="33" height="33">
      </div>
    `;
  });

  listaUsuarios.innerHTML += `
    <div data-toggle="tooltip" data-popup="tooltip-custom" data-placement="top"
          class="avatar pull-up" onclick="clickButtonVerModalEquipoEnBloque(${id})">
          <button type="button" "
          class="btn btn-icon btn-icon rounded-circle btn-info waves-effect waves-float waves-light">
          <i class="fa-solid fa-plus"></i>
      </button>
    </div>
  `;
}

function renderFormItem({ contenido }) {
  $("#contenido-item").summernote("code", contenido);
  $("#modalItem").modal("show");
}

// ------------------------------------------------------------------------------- SERVICES
function postUsuariosPorProyecto({ idProyecto }) {
  $.post(RUTA_GET_USUARIOS_PROYECTO, { idProyecto }, (response) => {
    const usuarios = JSON.parse(response);
    USUARIOS_PROYECTO = usuarios;

    renderUsuariosDeProyecto(usuarios);
  });
}

function verificarInvitacion({ codigoInvitacion }) {
  $.post(
    RUTA_VERIFICAR_INVITACION,
    { usuario: USUARIO, codigoInvitacion },
    (response) => {
      let invitacion = [];
      invitacion = JSON.parse(response);
      console.log(codigoInvitacion);
      if (invitacion.length !== 0) {
        invitacion = invitacion[0];

        renderInvitacion({
          isInvitado: true,
          propietario: invitacion.usuario_propietario,
        });
        CODIGO_INVITACION = invitacion.codigo;
        ID_PROYECTO_INVITACION = invitacion.proyecto;
      }
    }
  );
}

function postEquipo() {
  $.post(RUTA_GET_ULTIMO_PROYECTO, (response) => {
    if (response) {
      response = JSON.parse(response);
      const id = parseInt(response?.id);

      setTimeout(() => {
        $.post(
          RUTA_ADD_EQUIPO,
          {
            idProyecto: id,
            idUsuario: ID_USUARIO,
            idRol: 1,
          },
          (response) => {
            window.location = "principal";
          }
        );
      }, 1000);
    }
  });
}

function postProcesos({ idProyecto }) {
  $.post(RUTA_GET_PROCESOS, { idProyecto }, (response) => {
    procesos = JSON.parse(response);
    PROCESOS_USER = procesos;
    const idProceso = procesos[0]?.id;

    if (!idProceso) {
      $("#titulo-proceso").html("Aún no hay procesos");
      $(".project__element-proceso").html("");
      // $("#button-add-tarea").addClass("d-none");
      return;
    }

    // $("#button-add-bloque").removeClass("d-none");
    renderProcesos(procesos);
    renderProceso(idProceso);
  });
}

function postTareas({ idProyecto }) {
  $.post(RUTA_GET_TAREAS, { idProyecto }, (response) => {
    tareas = JSON.parse(response);
    TAREAS = tareas;
    postTagsTareasDeProyecto({
      idProyecto,
    });
    postItems({
      idProyecto,
    });
    postBloquesUsuariosDeProyecto({
      idProyecto,
    });
  });
}

function postTagsTareasDeProyecto({ idProyecto }) {
  $.post(
    RUTA_GET_TAGS_TAREAS_PROYECTO,
    { idProyecto },
    (response) => {
      tagsTareas = JSON.parse(response);
      TAGS_PROYECTO = tagsTareas;

      filtrarTareas(FILTRO);
    }
  );
}

function postTags() {
  $.post(RUTA_GET_TAGS, (response) => {
    tags = JSON.parse(response);
    TAGS = tags;
    renderTags(tags);
  });
}

function postAddBloqueTag({ isAdd = true } = {}) {
  let tags = [...$("#task-tag :selected")].map((e) => e.value);
  tags = tags.toString();
  if (isAdd) {
    $.post(RUTA_GET_ULTIMO_BLOQUE, (response) => {
      if (response) {
        response = JSON.parse(response);
        const id = parseInt(response?.id);

        setTimeout(() => {
          $.post(RUTA_ADD_BLOQUE_TAG, {
            idBloque: id,
            "tags-tarea": tags,
          });
        }, 400);
      }
    });
  } else {
    setTimeout(() => {
      $.post(RUTA_ADD_BLOQUE_TAG, {
        idBloque: ID_TAREA,
        "tags-tarea": tags,
      });
    }, 400);
  }
}

function postDeleteBloqueTag() {
  $.post(RUTA_DELETE_BLOQUE_TAG, {
    idBloque: ID_TAREA,
  });
}

function postEstados() {
  $.post(RUTA_GET_ESTADOS, (response) => {
    estados = JSON.parse(response);

    renderEstados(estados);
  });
}

function postItems({ idProyecto }) {
  $.post(RUTA_GET_ITEMS, { idProyecto }, (response) => {
    items = JSON.parse(response);
    ITEMS_USER = items;
  });
}

function postManualesItemsDeProyecto({ idProyecto, idItem }) {
  $.post(
    RUTA_GET_MANUALES_ITEMS_PROYECTO,
    { idProyecto },
    (response) => {
      manualesItems = JSON.parse(response);
      MANUALES_PROYECTO = manualesItems;

      // MOSTRAR SELECT MULTIPLE CON VALORES
      let manuales = manualesItems?.filter(({ id }) => idItem == id);

      manuales = manuales.map((manualKey) =>
        parseInt(
          MANUALES.find(({ id }) => id == manualKey.manual)?.id
        )
      );

      $("#idManual-item")
        .val([...manuales])
        .trigger("change");
    }
  );
}

function postBloquesUsuariosDeProyecto({ idProyecto }) {
  $.post(
    RUTA_GET_BLOQUES_USUARIOS_PROYECTO,
    { idProyecto },
    (response) => {
      USUARIOS_BLOQUE_USER = JSON.parse(response);
    }
  );
}

function postDeleteItemManual(idItem) {
  $.post(RUTA_DELETE_ITEM_MANUAL, {
    idItem,
  });
}

function postAddItemManual(idItem) {
  let manuales = [...$("#idManual-item :selected")].map(
    (e) => e.value
  );
  manuales = manuales.toString();
  setTimeout(() => {
    $.post(RUTA_ADD_ITEM_MANUAL, {
      idItem,
      "manuales-item": manuales,
    });
  }, 400);
}

// ------------------------------------------------------------------------------- EVENTOS
function clickButtonInvitacion() {
  $("#button-invitacion").on("click", () => {
    $.post(
      RUTA_ACEPTAR_INVITACION,
      {
        codigoInvitacion: CODIGO_INVITACION,
        idProyecto: ID_PROYECTO_INVITACION,
        idUsuario: ID_USUARIO,
      },
      (response) => {
        if (response) {
          renderInvitacion(false);

          window.location = "principal";
        }
      }
    );
  });
}

function clickButtonVerProyecto(idProyecto) {
  ID_PROYECTO = idProyecto;

  renderProyecto({ idProyecto });
  postUsuariosPorProyecto({ idProyecto });
  postProcesos({ idProyecto });
}

function clickButtonEliminarDeTarea() {
  $.post(
    RUTA_EDIT_TAREA_BLOQUE,
    {
      "tarea-tarea": "",
      idTarea: ID_TAREA,
    },
    (response) => {
      if (response) {
        postTareas({ idProyecto: ID_PROYECTO });
      }
    }
  );
}

function clickButtonOptionsTarea() {
  const listaTareas = document.querySelector(".listaTareas");
  listaTareas.addEventListener("click", (e) => {
    const element = e.target;
    if (element) {
      const elementItem = element.closest(".todo-item");
      const idTarea = parseInt(elementItem.id?.split("-")[1]);
      ID_TAREA = idTarea;

      if (
        element.tagName === "DIV" ||
        element.tagName === "SMALL" ||
        element.tagName === "SPAN"
      ) {
        clickButtonVerModalTarea(idTarea);
      }
      if (e.target.tagName === "INPUT") {
        const isSelected = $(`#customCheck${idTarea}`).prop(
          "checked"
        );

        $.post(
          RUTA_EDIT_LISTO_BLOQUE,
          {
            "listo-tarea": isSelected ? "on" : "",
            idTarea,
          },
          (response) => {
            if (response) {
              postTareas({ idProyecto: ID_PROYECTO });
            }
          }
        );
      }
      if (e.target.tagName === "IMG") {
        const findedTarea = TAREAS.find(({ id }) => id == idTarea);
        renderBloque(findedTarea);
        setTimeout(() => {
          renderItems(ITEMS_USER, findedTarea);
          renderUsuariosEnBloque(USUARIOS_BLOQUE_USER, findedTarea);
        }, 200);
      }
    }
  });
}

function clickButtonCollapseCard(id) {
  $(".card__content-" + id).toggleClass("show");
}

function clickButtonEliminarItem(idItem) {
  $.post(RUTA_ELIMINAR_ITEM, { idItem }, () => {
    postItems({ idProyecto: ID_PROYECTO });

    setTimeout(() => {
      renderItems(ITEMS_USER, { id: ID_TAREA });
    }, 500);
  });
}

function clickButtonVerModalEquipo() {
  const isUserAdmi = getUserRol();

  if (isUserAdmi) $("#modalEquipo").modal("show");
  else setAlertWarning("No tienes permisos de administrador");
}

function clickButtonVerModalEquipoEnBloque(idBloque) {
  ID_TAREA = idBloque;
  const isUserAdmi = getUserRol();

  if (isUserAdmi) $("#modalEquipoEnBloque").modal("show");
  else setAlertWarning("No tienes permisos de administrador");
}

function clickButtonVerModalProyecto(idProyecto = false) {
  const nameElement = "proyecto";
  const idformulario = `#form-${nameElement}`;
  const titulo = $(`#titulo-${nameElement}`).html();
  const isUserAdmi = getUserRol();

  const setHide = () => {
    if (!idProyecto) return false;
    if (titulo === MENSAJE_SIN_PROYECTOS) return true;
    if (!isUserAdmi) {
      setAlertWarning("No tienes permisos de administrador");
      return true;
    }
    return false;
  };

  if (setHide()) return;

  addOrEditModal({
    idformulario,
    idEdit: idProyecto,
    name: nameElement,
    isHide: setHide(),
    editAction: () => {
      const { proyecto, descripcion, fechafin } = PROYECTO_OBJETO;
      $("#nombre-proyecto").val(proyecto);
      $("#descripcion-proyecto").val(descripcion);
      $("#fechaFin-proyecto").val(fechafin);
    },
  });
}

function clickButtonVerModalProceso(idProceso = false) {
  const nameElement = "proceso";
  const idformulario = `#form-${nameElement}`;
  const titulo = $(`#titulo-${nameElement}`).html();
  const isUserAdmi = getUserRol();

  const setHide = () => {
    if (!idProceso) return false;
    if (titulo === MENSAJE_SIN_PROYECTOS) return true;
    if (!isUserAdmi) {
      setAlertWarning("No tienes permisos de administrador");
      return true;
    }
    return false;
  };

  if (setHide()) return;

  addOrEditModal({
    idformulario,
    idEdit: idProceso,
    name: nameElement,
    isHide: setHide(),
    editAction: () => {
      const { proceso, descripcion, proyecto } = PROCESO_OBJETO;
      $("#nombre-proceso").val(proceso);
      $("#descripcion-proceso").val(descripcion);
      $("#idProyecto-proceso").val(proyecto);
    },
  });
}

function clickButtonVerModalTarea(idTarea = false) {
  const nameElement = "tarea";
  const idformulario = `#form-${nameElement}`;
  ID_TAREA = idTarea;

  addOrEditModal({
    idformulario,
    idEdit: idTarea,
    name: nameElement,
    addAction: () => {
      $("#task-tag").val([]).trigger("change");
    },
    editAction: () => {
      findedTarea = TAREAS.find(({ id }) => id == idTarea);
      const { bloque, fechafin, proceso, estado, crucial, listo } =
        findedTarea;
      $("#nombre-tarea").val(bloque);
      $("#fechaFin-tarea").val(fechafin);
      $("#idProceso-tarea").val(proceso);
      $("#idEstado-tarea").val(estado);
      $("#crucial-tarea").prop(
        "checked",
        crucial == "t" ? true : false
      );
      $("#listo-tarea").prop("checked", listo == "t" ? true : false);

      // MOSTRAR SELECT MULTIPLE CON VALORES
      setTimeout(() => {
        let tags = TAGS_PROYECTO?.filter(({ id }) => idTarea == id);
        tags = tags.map((tagKey) =>
          parseInt(TAGS.find(({ tag }) => tag == tagKey.tag)?.id)
        );
        $("#task-tag")
          .val([...tags])
          .trigger("change");
      }, [200]);
    },
  });
}

$("#task-tag").on("select2:select", function (e) {});

function filtrarTareas(tipoFiltrado) {
  let tareas = [];

  if (tipoFiltrado === "listo") {
    tareas = TAREAS.filter(({ listo }) => listo === "t");
  } else if (tipoFiltrado === "no listo") {
    tareas = TAREAS.filter(({ listo }) => listo === "f");
  } else if (tipoFiltrado === "crucial") {
    tareas = TAREAS.filter(({ crucial }) => crucial === "t");
  }

  renderTareas(tareas);
  renderTagsEnTarea(TAGS_PROYECTO, tareas);
}

function clickButtonFiltrarTodos() {
  FILTRO = FILTROS[0];
  filtrarTareas(FILTROS[0]);
}

function clickButtonFiltrarImportantes() {
  FILTRO = FILTROS[2];
  filtrarTareas(FILTROS[2]);
}

function clickButtonFiltrarCompletadas() {
  FILTRO = FILTROS[1];
  filtrarTareas(FILTROS[1]);
}

function clickButtonFiltrarPorTag(tag) {
  const tags = TAGS_PROYECTO.filter((tagKey) => tag === tagKey?.tag);

  const tareas = TAREAS.filter((tareaKey) => {
    const { id } = tareaKey;
    const isFinded = tags.find((tagKey) => tagKey.id == id);
    return Boolean(isFinded);
  });

  renderTareas(tareas);
  renderTagsEnTarea(tags, tareas);
}

function clickButtonVerModalItemManual({ idBloque, idItem }) {
  ID_BLOQUE = idBloque;
  ID_ITEM = idItem;
  const nameElement = "itemOptions";
  const idformulario = `#form-${nameElement}`;

  addOrEditModal({
    idformulario,
    name: nameElement,
    idEdit: idItem,
    editAction: () => {
      findedItem = ITEMS_USER.find(({ id }) => id == idItem);
      const { tarea, listo } = findedItem;
      $("#tarea-item").prop("checked", tarea == "t" ? true : false);
      $("#listo-item").prop("checked", listo == "t" ? true : false);

      postManualesItemsDeProyecto({
        idProyecto: ID_PROYECTO,
        idItem,
      });
    },
  });
}

function clickButtonVerModalItem({ idBloque, idItem }) {
  ID_BLOQUE = idBloque;
  ID_ITEM = idItem;
  const nameElement = "item";
  const idformulario = `#form-${nameElement}`;

  addOrEditModal({
    idformulario,
    name: nameElement,
    idEdit: idItem,
    initAction: () => {
      $.post(RUTA_GET_ULTIMO_ITEM, (response) => {
        if (response) {
          response = JSON.parse(response);
          const ultimo = parseInt(response?.id) + 1;
          ID_ITEM_ULTIMO = ultimo;
        }
      });
    },
    addAction: () => {
      $("#contenido-item").summernote("code", "");
    },
    editAction: () => {
      $.post(RUTA_GET_ITEM, { idItem }, function (data) {
        data = JSON.parse(data);
        const { contenido } = data;
        renderFormItem({ contenido });
      });
    },
  });
}

function submitAddOrEditProyecto() {
  const nameElement = "proyecto";
  const formularioId = `#form-${nameElement}`;
  $(formularioId).submit(function (event) {
    const optionSubmit = $(formularioId).attr("name");
    const OPTION_ADD = `agregar-${nameElement}`;

    addOrEditFormulario({
      event,
      idFormulario: formularioId,
      name: nameElement,
      rutaEdit: RUTA_EDIT_PROYECTO,
      extraEdit: {
        idProyecto: ID_PROYECTO,
      },
      rutaAdd: RUTA_ADD_PROYECTO,
      extraAdd: {},
      responseAction: (response) => {
        if (response) {
          setTimeout(() => {
            optionSubmit === OPTION_ADD
              ? postEquipo()
              : (window.location = "principal");
          }, 1000);
        }
      },
    });
  });
}

function submitNewInvitacion() {
  const formulario = "#form-new-equipo";
  $(formulario).submit(function (event) {
    event.preventDefault();
    let formData = new FormData($(formulario)[0]);
    let usuarioEnEquipo = formData.get("email-destino-invitacion");

    $.post(
      RUTA_VERIFICAR_USUARIO_EQUIPO,
      {
        idProyecto: ID_PROYECTO,
        usuario: usuarioEnEquipo,
      },
      (response) => {
        response = JSON.parse(response);
        if (response?.length !== 0) {
          setAlertWarning("Usuario añadido con anterioridad");
        } else {
          doQueryAjax({
            event,
            idFormulario: formulario,
            ruta: RUTA_ENVIAR_EMAIL,
            extra: { usuario: USUARIO },
            onAction: (response) => {
              if (response) {
                $("#modalEquipo").modal("hide");
                setAlertSuccess("Invitación realizada");
              }
            },
          });
        }
      }
    );
  });
}

function submitAddOrEditProceso() {
  const nameElement = "proceso";
  const formularioId = `#form-${nameElement}`;
  $(formularioId).submit(function (event) {
    addOrEditFormulario({
      event,
      name: nameElement,
      idFormulario: formularioId,
      rutaAdd: RUTA_ADD_PROCESO,
      rutaEdit: RUTA_EDIT_PROCESO,
      extraEdit: {
        idProceso: ID_PROCESO,
      },
      responseAction: (response) => {
        if (response) {
          postProcesos({ idProyecto: ID_PROYECTO });
        }
      },
    });
  });
}

function submitAddOrEditTarea() {
  const nameElement = "tarea";
  const formulario = `#form-${nameElement}`;

  $(formulario).submit(function (event) {
    const optionSubmit = $(formulario).attr("name");
    const OPTION_ADD = `agregar-${nameElement}`;

    addOrEditFormulario({
      event,
      idFormulario: formulario,
      rutaAdd: RUTA_ADD_BLOQUE,
      rutaEdit: RUTA_EDIT_BLOQUE,
      name: nameElement,
      extraAdd: {
        "orden-tarea": "26",
        "fechaIni-tarea": moment().format("YYYY-MM-D"),
      },
      extraEdit: { idTarea: ID_TAREA, idUsuario: ID_USUARIO },
      responseAction: (response) => {
        if (response) {
          if (optionSubmit == OPTION_ADD) {
            postAddBloqueTag();
          } else {
            postDeleteBloqueTag();
            postAddBloqueTag({ isAdd: false });
          }

          setTimeout(() => {
            postTareas({ idProyecto: ID_PROYECTO });
          }, [1000]);
        }
      },
    });
  });
}

function submitNewUsuarioEnBloque() {
  const formulario = "#form-new-usuario-bloque";
  $(formulario).submit(function (event) {
    event.preventDefault();
    let formData = new FormData($(formulario)[0]);
    let idUsuarioEnBloque = formData.get("idUsuario-bloque");

    $.post(
      RUTA_VERIFICAR_USUARIO_BLOQUE,
      {
        idBloque: ID_TAREA,
        "idUsuario-bloque": idUsuarioEnBloque,
      },
      (response) => {
        if (response) {
          response = JSON.parse(response);
          if (response?.length !== 0) {
            setAlertWarning("Usuario añadido con anterioridad");
          } else {
            doQueryAjax({
              event,
              idFormulario: formulario,
              ruta: RUTA_ADD_USUARIO_BLOQUE,
              extra: { idBloque: ID_TAREA },
              onAction: (response) => {
                if (response) {
                  $("#modalEquipoEnBloque").modal("hide");
                  setAlertSuccess("Usuario designado");
                  postBloquesUsuariosDeProyecto({
                    idProyecto: ID_PROYECTO,
                    bloques: BLOQUES_USER,
                  });
                  setTimeout(() => {
                    renderUsuariosEnBloque(USUARIOS_BLOQUE_USER, {
                      id: ID_TAREA,
                    });
                  }, 500);
                }
              },
            });
          }
        }
      }
    );
  });
}

function submitAddOrEditItem() {
  const formularioId = "#form-item";
  $(formularioId).submit(function (event) {
    let formData = new FormData($(formularioId)[0]);
    let contenidoItem = formData.get("contenido-item");
    contenidoItem = contenidoItem.replace(/'/g, `"`);

    addOrEditFormulario({
      event,
      idFormulario: formularioId,
      rutaAdd: RUTA_ADD_ITEM,
      rutaEdit: RUTA_EDIT_ITEM,
      name: "item",
      extraAdd: {
        idUsuario: ID_USUARIO,
        "orden-item": ID_ITEM_ULTIMO,
        "idBloque-item": ID_TAREA,
        "contenido-item": contenidoItem,
      },
      extraEdit: { idItem: ID_ITEM, idUsuario: ID_USUARIO },
      responseAction: (response) => {
        postItems({ idProyecto: ID_PROYECTO });

        setTimeout(() => {
          renderItems(ITEMS_USER, { id: ID_TAREA });
        }, 500);
      },
    });
  });
}

function submitAddOrEditItemOptions() {
  const formularioId = "#form-itemOptions";
  $(formularioId).submit(function (event) {
    addOrEditFormulario({
      event,
      idFormulario: formularioId,
      rutaEdit: RUTA_EDIT_ITEM_OPTIONS,
      name: "itemOptions",
      extraEdit: { idItem: ID_ITEM },
      responseAction: (response) => {
        if (response) {
          postDeleteItemManual(ID_ITEM);
          postAddItemManual(ID_ITEM);

          setTimeout(() => {
            postItems({
              idProyecto: ID_PROYECTO,
            });
          }, [1000]);
        }
      },
    });
  });
}

// ------------------------------------ OBTENER USUARIO PARA PERMISOS
function getUserRol() {
  const isUserAdmi = USUARIOS_PROYECTO.find((usuarioKey) => {
    const { id, rol } = usuarioKey;
    return id === ID_USUARIO && rol === "Administrador";
  });
  return isUserAdmi;
}

// ------------------------------------ LLAMAR INICIO
init();
