const RUTA_CONTROLLER = "../controller/gestionar_usuarios.php?op=";

const RUTA_GET_USUARIOS = RUTA_CONTROLLER + "listarUsuarios";

let USUARIO = "No hay usuario";
let ID_USUARIO;
let ID_MODULO = 1;

// ----------------------------------------- INICIACIÓN
function init() {
  //  Renderizados
  renderInitial();

  //   Eventos
}

// ----------------------------------------- RENDERIZADOS
function renderInitial() {
  renderInitialTemplate(ID_MODULO, (response) => {
    if(response){
      postUsuarios()
    }
  });
}

function renderUsuarios(usuarios = []){
  const listaUsuarios = document.getElementById('listaUsuarios')

  listaUsuarios.innerHTML = ""

  usuarios.forEach((usuarioKey) => {
    const {
      id, 
      usuario, 
      nombre,
      apellido_materno,
      apellido_paterno,
      pregunta_secreta,
      respuesta_secreta
    } = usuarioKey

    listaUsuarios.innerHTML += `
    <tr>
      <td>
          <span class="badge rounded-pill badge-light-primary me-1">${id}</span
          // <span class="fw-bold"></span>
      </td>
      <td>${usuario}</td>
      <td>${nombre}</td>
      <td>${apellido_paterno} ${apellido_materno}</td>
      <td>${pregunta_secreta}</td>
      <td>${respuesta_secreta}</td>
      <td>
          <div class="dropdown " >
              <button type="button" onclick="clickDropdown(${id})" 
                  class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                      viewBox="0 0 24 24" fill="none" stroke="currentColor"
                      stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                      class="feather feather-more-vertical">
                      <circle cx="12" cy="12" r="1"></circle>
                      <circle cx="12" cy="5" r="1"></circle>
                      <circle cx="12" cy="19" r="1"></circle>
                  </svg>
              </button>
              <div class="dropdown-menu" id="dropdown-${id}" style="">
                  <a class="dropdown-item" onclick="clickEditarUsuario(${id})">
                      <span>Edit</span>
                  </a>
                  <a class="dropdown-item" onclick="clickEliminarUsuario(${id})">
                      <span>Delete</span>
                  </a>
              </div>
          </div>
      </td>
  </tr>
    `
  })
}


// ------------------------------------------------------------------------------- SERVICES
function postUsuarios() {
  $.post(RUTA_GET_USUARIOS, (response) => {
    usuarios = JSON.parse(response);

    renderUsuarios(usuarios);
  });
}

// ------------------------------------------------------------------------------- EVENTOS
function clickDropdown(id) {
 const isExisted = document.getElementById(`dropdown-${id}`).classList.contains('show');

 if(!isExisted) $(`#dropdown-${id}`).dropdown('toggle')
 else $(`#dropdown-${id}`).dropdown('hide')
}

function clickEditarUsuario(id) {
 console.log(id +  'editado')
}

function clickButtonEliminarItem(idItem) {
  $.post(RUTA_ELIMINAR_ITEM, { idItem }, () => {
    postItems({ bloques: BLOQUES_USER, idProceso: ID_PROCESO });
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
    addAction: () => {
      $("#idProyecto-proceso").val(ID_PROYECTO);
    },
    editAction: () => {
      const { proceso, descripcion, proyecto } = PROCESO_OBJETO;
      $("#nombre-proceso").val(proceso);
      $("#descripcion-proceso").val(descripcion);
      $("#idProyecto-proceso").val(proyecto);
    },
  });
}

function submitAddOrEditProceso() {
  const nameElement = "proceso";

  const formularioId = `#form-${nameElement}`;
  $(formularioId).submit(function (event) {
    addOrEditFormulario({
      event,
      idFormulario: formularioId,
      rutaAdd: RUTA_ADD_PROCESO,
      rutaEdit: RUTA_EDIT_PROCESO,
      name: nameElement,
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

// ------------------------------------ OBTENER USUARIO PARA PERMISOS

// ------------------------------------ LLAMAR INICIO
init();

$(document).ready(function () {
  $("#table_id").DataTable();
});
