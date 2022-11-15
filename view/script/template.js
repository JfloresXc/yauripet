const RUTA_CONTROLLER_TMP = "../controller/principal.php?op=";

const RUTA_LOGOUT_TMP = RUTA_CONTROLLER_TMP + "logout";
const RUTA_GET_USUARIO_TMP = RUTA_CONTROLLER_TMP + "mostrarUsuario";
const RUTA_VERIFICAR_USUARIO_MODULO = RUTA_CONTROLLER_TMP + "validarModuloUsuario";
const RUTA_LISTAR_USUARIO_MODULOS = RUTA_CONTROLLER_TMP + "listarModulosUsuario";
const RUTA_SESION_USUARIO_TMP =
  RUTA_CONTROLLER_TMP + "mostrarSesionUsuario";

// ----------------------------------------- INICIACIÓN
function init() {
  //  Renderizados
  // renderInitial();
  //   Eventos
  clickButtonLogout();
}

function renderInitialTemplate(idModulo, nextAction = () => {}) {
  $.post(RUTA_SESION_USUARIO_TMP, (response) => {
    const data = JSON.parse(response);

    const responseUser = data[0];
    ID_USUARIO = data[2];
    USUARIO = responseUser;
    renderUser({ nombre: data[1], username: responseUser });

    $.post(RUTA_LISTAR_USUARIO_MODULOS, {idUsuario: ID_USUARIO}, (response) => {
      const data = JSON.parse(response);
      renderUsuarioModulos(data)
    })

    if(idModulo == '-1') return

    $.post(RUTA_VERIFICAR_USUARIO_MODULO, {idModulo, idUsuario: ID_USUARIO}, (response) => {
      const data = JSON.parse(response);

      if(data) nextAction(data)
      else location.href = 'principal'
    })
  });
}

// ------------------------------------------------------------------------------- RENDERIZADOS
function renderUser({ nombre, username }) {
  $("#username-usuario").text(username);
  $("#nombre-usuario").text(nombre);
}

function renderUsuarioModulos(modulos = []) {
  let listaModulos = document.getElementById('main-menu-navigation')

  listaModulos.innerHTML = ""

  modulos.forEach((moduloKey) => {
    const {nombre, descripcion} = moduloKey

    console.log(moduloKey)

    listaModulos.innerHTML += `
      <li class="nav-item">
        <a class="d-flex align-items-center" href="${nombre}">
            <i class="fa-solid fa-paw"></i>
            <span class="menu-title text-truncate" data-i18n="${descripcion}">${descripcion}</span>
        </a>
      </li>
    `
  })
}

// ------------------------------------------------------------------------------- SERVICES

// ------------------------------------------------------------------------------- EVENTOS
function clickButtonLogout() {
  $("#button-logout").on("click", () => {
    $.post(RUTA_LOGOUT_TMP, (response) => {
      if (response) {
        window.location = "login";
      }
    });
  });
}

// ------------------------------------------------------------------------------- FUNCIONES FORMULARIO
function addOrEditModal({
  idformulario,
  idEdit,
  name,
  initAction = () => {},
  addAction = () => {},
  editAction = () => {},
  isHide = false,
}) {
  initAction();

  const nameUper = aCapitalizar(name);
  let textoEdit = `Editar ${name}`;
  let textoAdd = `Agregar ${name}`;

  if (!idEdit) {
    $(idformulario).attr(`name`, `agregar-${name}`);
    limpiarFormulario(idformulario);
    $(`#form-button-${name}`).html(textoAdd);
    $(`#form-title-${name}`).html(textoAdd);

    addAction();
  } else {
    $(idformulario).attr(`name`, `editar-${name}`);
    $(`#form-button-${name}`).html(textoEdit);
    $(`#form-title-${name}`).html(textoEdit);
    editAction();
  }

  if (!isHide) $(`#modal${nameUper}`).modal(`show`);
}

function addOrEditFormulario({
  event,
  idFormulario,
  name,
  rutaAdd,
  rutaEdit,
  extraAdd = {},
  extraEdit = {},
  responseAction,
}) {
  const optionSubmit = $(idFormulario).attr("name");
  const OPTION_ADD = `agregar-${name}`;
  const nameUper = aCapitalizar(name);

  doQueryAjax({
    event,
    idFormulario,
    ruta: optionSubmit === OPTION_ADD ? rutaAdd : rutaEdit,
    extra: optionSubmit === OPTION_ADD ? extraAdd : extraEdit,
    onAction: (response) => {
      if (response) {
        $(`#modal${nameUper}`).modal(`hide`);
        setAlertSuccess(
          optionSubmit === OPTION_ADD
            ? `${nameUper} agregado`
            : `${nameUper} editado`
        );
        responseAction(response);
      }
    },
  });
}

function doQueryAjax({
  event,
  idFormulario,
  ruta,
  extra = null,
  onAction,
} = {}) {
  event.preventDefault();
  let formData = new FormData($(idFormulario)[0]);

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
    success: function (respuesta) {
      onAction(respuesta);
      limpiarFormulario(idFormulario);
    },
    error: function (error) {
      console.log(error.responseText);

      setAlertError("Error al realizar el envío ajax");
    },
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


