const RUTA_CONTROLLER = "../controller/principal.php?op=";

const RUTA_GET_PROYECTOS = RUTA_CONTROLLER + "listarProyectos";
const RUTA_GET_PROYECTO = RUTA_CONTROLLER + "changeProyecto";
const RUTA_ADD_PROYECTO = RUTA_CONTROLLER + "agregarProyecto";
const RUTA_ADD_INVITACION = RUTA_CONTROLLER + "agregarInvitacion";
const RUTA_GET_PROCESOS = RUTA_CONTROLLER + "listarProcesos";
const RUTA_ADD_PROCESO = RUTA_CONTROLLER + "agregarProceso";
const RUTA_GET_BLOQUES = RUTA_CONTROLLER + "listarBloques";
const RUTA_ADD_BLOQUE = RUTA_CONTROLLER + "agregarBloque";
const RUTA_GET_ESTADOS = RUTA_CONTROLLER + "listarEstados";
const RUTA_GET_ITEMS = RUTA_CONTROLLER + "listarItems";
const RUTA_ADD_ITEM = RUTA_CONTROLLER + "agregarItem";
const RUTA_GET_ULTIMO_ITEM = RUTA_CONTROLLER + "mostrarUltimoItem";
const RUTA_EDIT_ITEM = RUTA_CONTROLLER + "editarItem";
const RUTA_ADD_IMAGEN = RUTA_CONTROLLER + "agregarImagen";
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
let BLOQUES_USER = [];
let ITEMS_USER = [];
let ID_ITEM;
let ID_ITEM_ULTIMO;
let CODIGO_INVITACION;

// ----------------------------------------- INICIACIÓN
function init() {
  //  Renderizados
  renderInitial();

  //   Eventos
  clickButtonAgregarItem();
  clickButtonLogout();
  clickButtonInvitacion();
  changeProyecto();
  submitNewProyecto();
  submitNewInvitacion();
  submitNewProceso();
  submitNewBloque();
  submitAddOrEditItem();
  // submitNewImage();
}

// ----------------------------------------- RENDERIZADOS
function renderInitial() {
  $.post(RUTA_SESION_USUARIO, (responseUser) => {
    USUARIO = responseUser;

    $.post(
      RUTA_GET_PROYECTOS,
      { usuario: responseUser },
      (responseProjects) => {
        const proyectos = JSON.parse(responseProjects);
        PROYECTOS_USER = proyectos;
        ID_PROYECTO = proyectos[0]?.id;
        const idProyecto = proyectos[0]?.id;

        renderProyectos(proyectos);
        renderProyecto({ idProyecto });
        postUsuariosPorProyecto({ idProyecto });
        postProcesos({ idProyecto });

        postEstados();
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

function renderProyectos(proyectos = []) {
  const listaProyectos = document.getElementById("idProyecto");
  const listaProyectosEnProcesos = document.getElementById(
    "idProyecto-proceso"
  );
  const listaProyectosEnInvitacion = document.getElementById(
    "idProyecto-invitacion"
  );

  listaProyectos.innerHTML = "";
  listaProyectosEnProcesos.innerHTML = "";
  listaProyectosEnInvitacion.innerHTML = "";

  proyectos?.map((proyectoKey) => {
    const { proyecto, id } = proyectoKey;
    listaProyectos.innerHTML += `<option value=${id}>${proyecto}</option>`;
    listaProyectosEnProcesos.innerHTML += `<option value=${id}>${proyecto}</option>`;
    listaProyectosEnInvitacion.innerHTML += `<option value=${id}>${proyecto}</option>`;
  });
}

function renderProyecto({ idProyecto }) {
  $.post(RUTA_GET_PROYECTO, { idProyecto }, (data) => {
    data = JSON.parse(data);
    $("#descripcionProyecto").text(data.descripcion);
    $("#nombreProyecto").html(data.proyecto);
  });
}

function renderUsuariosDeProyecto(usuarios = []) {
  const listaUsuarios = document.querySelector(".equipo__usuarios");

  listaUsuarios.innerHTML = "";

  usuarios?.forEach((usuarioKey) => {
    const { nombre, id } = usuarioKey;
    const letra1 = `${nombre}`[0].toUpperCase();
    listaUsuarios.innerHTML += `
      <label title="${nombre}" class="equipo__usuario"  id="user-${id}">
        <span>${letra1}</span>
      </label>
    `;
  });
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
  // const listaProcesosEnBloques = document.getElementById(
  //   "idProceso-bloque"
  // );

  listaProcesos.innerHTML = "";
  // listaProcesosEnBloques.innerHTML = "";

  procesos?.map((procesoKey) => {
    const { proceso, id } = procesoKey;
    listaProcesos.innerHTML += `
      <div 
          class='proceso__button external-event bg-secondary ui-draggable ui-draggable-handle' 
          id='proceso-${id}'
          style='position: relative;' 
          onclick='renderProceso(${id})'
      >
      ${proceso}
      </div>
    `;

    // listaProcesosEnBloques.innerHTML += `
    //   <option value=${id}>${proceso}</option>
    // `;
  });
}

function renderProceso(idProceso) {
  $.post(
    "../controller/principal.php?op=mostrarProceso",
    { idProceso },
    function (data) {
      ID_PROCESO = idProceso;

      $(".proceso__button").removeClass("bg-info");
      $("#proceso-" + idProceso).addClass("bg-info");

      data = JSON.parse(data);
      $("#tituloCardProceso").html(
        data.proceso + " (" + data.descripcion + ")"
      );

      postBloques({ idProceso: idProceso });
    }
  );
}

function renderBloques(bloques = []) {
  const listaBloques = document.getElementById("listaBloques");
  const listaBloquesEnItem = document.getElementById("idBloque-item");
  // const listaBloquesEnItemTexto = document.getElementById(
  //   "idBloque-item-texto"
  // );
  const listaBloquesEnItemImagen = document.getElementById(
    "idBloque-item-imagen"
  );

  listaBloques.innerHTML = "";
  // listaBloquesEnItem.innerHTML = "";
  // listaBloquesEnItemTexto.innerHTML = "";
  // listaBloquesEnItemImagen.innerHTML = "";

  bloques?.map((bloqueKey) => {
    const { bloque, id } = bloqueKey;
    listaBloques.innerHTML += `
          <div class="card card-lightblue"
              style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">
              <div class="card-header">
                  <h3 class="card-title">${bloque}</h3>
                  <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="maximize">
                          <i class="fas fa-expand"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                          <i class="fas fa-minus"></i>
                      </button>
                  </div>
              </div>
              <div class="card-body" id='${
                "bloque-" + id
              }' style="display: block;">
                  
              </div>
          </div>
    `;

    // listaBloquesEnItem.innerHTML += `
    //   <option value=${id}>${bloque}</option>
    // `;

    // listaBloquesEnItemTexto.innerHTML += `
    //   <option value=${id}>${bloque}</option>
    // `;

    // listaBloquesEnItemImagen.innerHTML += `
    //   <option value=${id}>${bloque}</option>
    // `;
  });
}

function renderEstados(estados = []) {
  const listaEstadosEnBloque =
    document.getElementById("idEstado-bloque");

  listaEstadosEnBloque.innerHTML = "";

  estados?.map((estadoKey) => {
    const { estado, id } = estadoKey;
    listaEstadosEnBloque.innerHTML += `
      <option value=${id}>${estado}</option>
    `;
  });
}

function renderItems(items = [], bloques = []) {
  bloques.forEach((bloqueKey) => {
    const listaItems = document.getElementById(
      "bloque-" + bloqueKey?.id
    );
    listaItems.innerHTML = "";

    const itemsFilter = items.filter((itemKey) => {
      return itemKey?.bloque === bloqueKey?.id;
    });

    itemsFilter.forEach((itemKey) => {
      const { tipo, contenido, id } = itemKey;

      if (tipo == "1") {
        listaItems.innerHTML += `
        <div class="w-100 d-flex justify-content-between align-item-center">
          <div>${itemKey?.contenido}</div>
          
          <div class="dropdown item__button-setting">
            <button class="btn btn-secondary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-ellipsis-v"></i>
            </button>
            <ul class="dropdown-menu">
              <li>
                <button class="dropdown-item text-success" onclick="clickButtonEditarItem(${id})">
                  <i class="fas fa-pen"></i>
                  Editar
                </button>
              </li>
              <li>
                <button class="dropdown-item text-danger" onclick="clickButtonEliminarItem(${id})">
                  <i class="fas fa-ban"></i>
                  Eliminar
                </button>
              </li>
            </ul>
          </div>
        </div>
      `;
      } else if (tipo == "2") {
        listaItems.innerHTML += `
        <div class="bloque mb-3  d-flex justify-content-between">
            <img src=${contenido}
            class="bloque__imagen"
                alt="item imagen ${id}" >
        </div>
      `;
      }
    });
  });
}

function renderFormItem({ bloque, contenido, orden }) {
  // $("#idBloque-item-texto").val(bloque);
  // $("#contenido-item-texto").val(contenido);
  // $("#orden-item-texto").val(orden);
  $("#idBloque-item").val(bloque);
  $("#contenido-item").summernote("code", contenido);
  // $("#orden-item").val(orden);

  $("#modalNewItem").modal("show");
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

    postBloques({ idProceso });

    renderProcesos(procesos);
    renderProceso(idProceso);
  });
}

function postBloques({ idProceso }) {
  $.post(RUTA_GET_BLOQUES, { idProceso }, (response) => {
    bloques = JSON.parse(response);
    BLOQUES_USER = bloques;

    renderBloques(bloques);
    postItems({ idProceso, bloques });
  });
}

function postEstados() {
  $.post(RUTA_GET_ESTADOS, {}, (response) => {
    estados = JSON.parse(response);

    renderEstados(estados);
  });
}

function postItems({ idProceso, bloques }) {
  $.post(RUTA_GET_ITEMS, { idProceso }, (response) => {
    items = JSON.parse(response);
    ITEMS_USER = items;

    renderItems(items, bloques);
  });
}

// ------------------------------------------- EVENTOS
function clickButtonEditarItem(idItem) {
  // $("#form-new-item-texto").attr("name", "editar");
  // $("#form-button-item-texto").html("Editar item");
  // $("#form-button-item-imagen").html("Editar item");

  // ID_ITEM = idItem;
  // $.post(
  //   "../controller/principal.php?op=mostrarItem",
  //   { idItem },
  //   function (data) {
  //     data = JSON.parse(data);
  //     const { bloque, contenido, orden } = data;
  //     renderFormItem({ bloque, contenido, orden });
  //   }
  // );

  $("#form-new-item").attr("name", "editar");
  $("#form-button-item").html("Editar item");
  $("#form-button-item-imagen").html("Editar item");

  ID_ITEM = idItem;
  $.post(
    "../controller/principal.php?op=mostrarItem",
    { idItem },
    function (data) {
      data = JSON.parse(data);
      const { bloque, contenido, orden } = data;
      renderFormItem({ bloque, contenido, orden });
    }
  );
}

function clickButtonEliminarItem(idItem) {
  $.post(
    "../controller/principal.php?op=eliminarItem",
    { idItem },
    () => {
      // renderFormItem({ bloque, contenido, orden });
      postBloques({ idProceso: ID_PROCESO });
    }
  );
}

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

function clickButtonAgregarItem() {
  $("#button-modal-item").on("click", () => {
    $("#form-new-item").attr("name", "agregar");
    $("#form-new-item")[0].reset();
    $("#contenido-item").summernote("code", "");

    $("#form-button-item").html("Agregar item");
    $("#form-button-item-imagen").html("Agregar item");

    $.post(RUTA_GET_ULTIMO_ITEM, (response) => {
      if (response) {
        response = JSON.parse(response);
        const ultimo = parseInt(response?.id) + 1;
        ID_ITEM_ULTIMO = ultimo;
      }
    });
  });
}

function changeProyecto() {
  $("#idProyecto").on("change", function () {
    const idProyecto = this.value;
    ID_PROYECTO = this.value;

    renderProyecto({ idProyecto });
    postUsuariosPorProyecto({ idProyecto });
    postProcesos({ idProyecto });
  });
}

function submitNewProyecto() {
  $("#form-new-proyecto").submit(function (event) {
    event.preventDefault();

    doQueryAjax({
      event,
      peticion: "#form-new-proyecto",
      ruta: RUTA_ADD_PROYECTO,
      mensage: "Proyecto agregado",
    });

    postProyectos(PROYECTOS_USER);
  });
}

function submitNewInvitacion() {
  $("#form-new-invitacion").submit(function (event) {
    event.preventDefault();

    doQueryAjax({
      event,
      peticion: "#form-new-invitacion",
      ruta: RUTA_ENVIAR_EMAIL,
      mensage: "Invitación realizada",
      extra: { usuario: USUARIO },
    });
  });
}

function submitNewProceso() {
  $("#form-new-proceso").submit(function (event) {
    event.preventDefault();

    doQueryAjax({
      event,
      peticion: "#form-new-proceso",
      ruta: RUTA_ADD_PROCESO,
      mensage: "Proceso agregado",
    });

    postProcesos({ idProyecto: ID_PROYECTO });
  });
}

function submitNewBloque() {
  $("#form-new-bloque").submit(function (event) {
    event.preventDefault();

    doQueryAjax({
      event,
      peticion: "#form-new-bloque",
      ruta: RUTA_ADD_BLOQUE,
      mensage: "Bloque agregado",
    });

    postBloques({ idProceso: ID_PROCESO });
  });
}

function submitAddOrEditItem() {
  $("#form-new-item").submit(function (event) {
    const optionSubmit = $("#form-new-item").attr("name");
    event.preventDefault();

    doQueryAjax({
      event,
      peticion: "#form-new-item",
      ruta:
        optionSubmit === "agregar" ? RUTA_ADD_ITEM : RUTA_EDIT_ITEM,
      mensage:
        optionSubmit === "agregar" ? "Item agregado" : "Item editado",
      extra:
        optionSubmit === "agregar"
          ? { idUsuario: ID_USUARIO, "orden-item": ID_ITEM_ULTIMO }
          : { idItem: ID_ITEM, idUsuario: ID_USUARIO },
    });

    postBloques({ idProceso: ID_PROCESO });
    $("#modalNewItem").modal("hide");
  });
}

function submitNewImage() {
  $("#form-new-imagen").submit(function (event) {
    event.preventDefault();

    doQueryAjax({
      event,
      peticion: "#form-new-imagen",
      ruta: RUTA_ADD_IMAGEN,
      mensage: "Imagen agregada",
    });

    postBloques({ idProceso: ID_PROCESO });
  });
}

// -------------------------------------------- PETICIONES FORMULARIO
function doQueryAjax({
  event,
  peticion,
  ruta,
  mensage,
  extra = null,
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
      console.log(datos);

      Swal.fire({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        icon: "success",
        title: mensage,
      });
    },
    error: function (error) {
      console.log(error.responseText);

      Swal.fire({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 5000,
        icon: "error",
        title: "Error al hacer el envío",
      });
    },
  });
}

// ------------------------------------ LLAMAR INICIO
init();

// Summernote
// $(document).ready(function () {
//   $("#contenido-item").summernote({
//     placeholder: "Hello Bootstrap 4",
//     tabsize: 2,
//     height: 300,
//     minHeight: null,
//     maxHeight: null,
//     focus: true,
//   });
// });

window.addEventListener("load", () => {
  console.log("Termino de cargarse");
});
