const RUTA_CONTROLLER = "../controller/principal.php?op=";

const RUTA_GET_PROYECTOS = RUTA_CONTROLLER + "listarProyectos";
const RUTA_GET_PROYECTO = RUTA_CONTROLLER + "changeProyecto";
const RUTA_ADD_PROYECTO = RUTA_CONTROLLER + "agregarProyecto";
const RUTA_GET_ULTIMO_PROYECTO =
  RUTA_CONTROLLER + "mostrarUltimoProyecto";
const RUTA_ADD_INVITACION = RUTA_CONTROLLER + "agregarInvitacion";
const RUTA_GET_PROCESOS = RUTA_CONTROLLER + "listarProcesos";
const RUTA_ADD_PROCESO = RUTA_CONTROLLER + "agregarProceso";
const RUTA_GET_BLOQUES = RUTA_CONTROLLER + "listarBloques";
const RUTA_GET_BLOQUES_USUARIOS_PROYECTO =
  RUTA_CONTROLLER + "listarBloquesUsuariosDeProyecto";
const RUTA_GET_ULTIMO_BLOQUE =
  RUTA_CONTROLLER + "mostrarUltimoBloque";
const RUTA_ADD_BLOQUE = RUTA_CONTROLLER + "agregarBloque";
const RUTA_ADD_USUARIO_BLOQUE =
  RUTA_CONTROLLER + "agregarUsuarioBloque";
const RUTA_VERIFICAR_USUARIO_BLOQUE =
  RUTA_CONTROLLER + "verificarUsuarioBloque";
const RUTA_GET_ESTADOS = RUTA_CONTROLLER + "listarEstados";
const RUTA_GET_ITEMS = RUTA_CONTROLLER + "listarItems";
const RUTA_ADD_ITEM = RUTA_CONTROLLER + "agregarItem";
const RUTA_GET_ULTIMO_ITEM = RUTA_CONTROLLER + "mostrarUltimoItem";
const RUTA_EDIT_ITEM = RUTA_CONTROLLER + "editarItem";
const RUTA_ADD_IMAGEN = RUTA_CONTROLLER + "agregarImagen";
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
const RUTA_ENVIAR_EMAIL =
  "../controller/enviar-correo.php?op=enviarMail";

let USUARIO = "No hay usuario";
let ID_USUARIO;
let ID_PROYECTO;
let ID_PROYECTO_INVITACION;
let PROYECTOS_USER = [];
let ID_PROCESO;
let PROCESOS_USER = [];
let ID_BLOQUE;
let BLOQUES_USER = [];
let ITEMS_USER = [];
let ID_ITEM;
let ID_ITEM_ULTIMO;
let CODIGO_INVITACION;
let USUARIOS_PROYECTO = [];
let BLOQUES_USER_PROYECTO = [];

// ----------------------------------------- INICIACIÓN
function init() {
  //  Renderizados
  renderInitial();

  //   Eventos
  clickButtonLogout();
  clickButtonInvitacion();
  submitNewProyecto();
  submitNewInvitacion();
  submitNewProceso();
  // submitNewBloque();
  // submitNewUsuarioEnBloque();
  // submitAddOrEditItem();
}

// ----------------------------------------- RENDERIZADOS
function renderInitial() {
  $.post(RUTA_SESION_USUARIO, (response) => {
    console.log(response);
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
          $("#nombre-proyecto").html("Aún no hay proyectos");
          $(".project__element").html("");
          return;
        }

        renderProyectos(proyectos);
        renderProyecto({ idProyecto });
        postUsuariosPorProyecto({ idProyecto });
        postProcesos({ idProyecto });

        // postEstados();
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

    $("#nombre-proyecto").html("Proyecto " + data.proyecto);
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
  const listaProcesos = document.getElementById("listaProcesos");
  const cantidadProcesos = document.getElementById(
    "cantidad-proceso"
  );
  const listaProcesosEnBloques = document.getElementById(
    "idProceso-bloque"
  );

  cantidadProcesos.innerHTML = procesos.length;
  listaProcesos.innerHTML = "";
  listaProcesosEnBloques.innerHTML = "";

  procesos?.map((procesoKey) => {
    const { proceso, id } = procesoKey;
    listaProcesos.innerHTML += `
      <li id="proceso-${id}" class="proceso__button" onclick="renderProceso(${id})">
          <a class="d-flex align-items-center" >
              <i data-feather="circle"></i>
              <span class="menu-item text-truncate" data-i18n="${proceso}">
                ${proceso}
              </span>
          </a>
      </li>
   `;

    listaProcesosEnBloques.innerHTML += `
      <option value=${id}>${proceso}</option>
    `;
  });
}

function renderProceso(idProceso) {
  $.post(
    "../controller/principal.php?op=mostrarProceso",
    { idProceso },
    function (data) {
      ID_PROCESO = idProceso;

      $(".proceso__button").removeClass("active");
      $("#proceso-" + idProceso).addClass("active");

      data = JSON.parse(data);
      $("#titulo-proceso").html("Proceso " + data.proceso);

      postBloques({ idProceso });
    }
  );
}

// ----------------------------------------- SERVICES
function postProyectos() {
  $.post(RUTA_GET_PROYECTOS, (response) => {
    const proyectos = JSON.parse(response);
    PROYECTOS_USER = proyectos;

    renderProyectos(proyectos);
  });
}

function postUsuariosPorProyecto({ idProyecto }) {
  $.post(RUTA_GET_USUARIOS_PROYECTO, { idProyecto }, (response) => {
    const usuarios = JSON.parse(response);
    USUARIOS_PROYECTO = usuarios;

    // renderUsuariosDeProyecto(usuarios);
  });
}

function verificarInvitacion({ codigoInvitacion }) {
  $.post(
    RUTA_VERIFICAR_INVITACION,
    { usuario: USUARIO, codigoInvitacion },
    (response) => {
      let invitacion = [];
      invitacion = JSON.parse(response);
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

function postProcesos({ idProyecto }) {
  $.post(RUTA_GET_PROCESOS, { idProyecto }, (response) => {
    procesos = JSON.parse(response);
    PROCESOS_USER = procesos;
    const idProceso = procesos[0]?.id;

    // postBloques({ idProceso });

    renderProcesos(procesos);
    // renderProceso(idProceso);
  });
}

// ------------------------------------------------------------------------ EVENTOS
function clickButtonLogout() {
  $("#button-logout").on("click", () => {
    $.post(RUTA_LOGOUT, (response) => {
      if (response) {
        window.location = "login";
      }
    });
  });
}

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

  // renderProyecto({ idProyecto });
  // postUsuariosPorProyecto({ idProyecto });
  postProcesos({ idProyecto });
}

function clickButtonVerModalEquipo() {
  const isUserAdmi = USUARIOS_PROYECTO.find((usuarioKey) => {
    const { id, rol } = usuarioKey;
    return id === ID_USUARIO && rol === "Administrador";
  });

  if (isUserAdmi) $("#modalEquipo").modal("show");
  else setAlertWarning("No tienes permisos de administrador");
}

function clickButtonVerModalProyecto() {
  $("#modalProyecto").modal("show");
}

function clickButtonVerModalProceso() {
  $("#modalProceso").modal("show");
}

// ------------------------------------------------------------------------ SUBMIT FORMULARIOS
function submitNewProyecto() {
  const formularioId = "#form-new-proyecto";
  $(formularioId).submit(function (event) {
    event.preventDefault();

    doQueryAjax({
      event,
      peticion: formularioId,
      ruta: RUTA_ADD_PROYECTO,
      onAction: (response) => {
        if (response) setAlertSuccess("Proyecto agregado");
      },
    });

    setTimeout(() => {
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
    }, 1000);
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
            peticion: formulario,
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

function submitNewProceso() {
  const formulario = "#form-new-proceso";
  $(formulario).submit(function (event) {
    event.preventDefault();

    doQueryAjax({
      event,
      peticion: formulario,
      ruta: RUTA_ADD_PROCESO,
      onAction: (response) => {
        if (response) {
          $("#modalProceso").modal("hide");
          setAlertSuccess("Proceso agregado");
        }
      },
    });

    postProcesos({ idProyecto: ID_PROYECTO });
  });
}

function submitNewBloque() {
  //   const formulario = "#form-new-bloque";
  //   $(formulario).submit(function (event) {
  //     event.preventDefault();
  //     doQueryAjax({
  //       event,
  //       peticion: formulario,
  //       ruta: RUTA_ADD_BLOQUE,
  //       extra: {
  //         "orden-bloque": "20",
  //         "fechaIni-bloque": moment().format("YYYY-MM-D"),
  //       },
  //       onAction: (response) => {
  //         if (response) {
  //           $("#modalBloque").modal("hide");
  //           setAlertSuccess("Bloque agregado");
  //           postBloques({ idProceso: ID_PROCESO });
  //         }
  //       },
  //     });
  //   });
}

// -------------------------------------------- PETICIONES FORMULARIO
function doQueryAjax({
  event,
  peticion,
  ruta,
  extra = null,
  onAction,
} = {}) {
  event.preventDefault();
  let formData = new FormData($(peticion)[0]);

  if (extra) {
    let keys = Object?.keys(extra);
    let values = Object?.values(extra);

    keys.forEach((key, index) => {
      formData.append([key], values[index]);
    });
  }

  $.ajax({
    url: ruta,
    type: "POST",
    data: formData,
    contentType: false,
    processData: false,
    success: function (datos) {
      onAction(datos);
    },
    error: function (error) {
      console.log(error.responseText);

      setAlertError("Error al realizar el envío ajax");
    },
  });
}

// ------------------------------------ LLAMAR INICIO
init();
