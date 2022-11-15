


let USUARIO = "No hay usuario";
let ID_USUARIO;
let ID_MODULO = -1;

// ----------------------------------------- INICIACIÓN
function init() {
  //  Renderizados
  renderInitial();

  //   Eventos
}

// ----------------------------------------- RENDERIZADOS
function renderInitial() {
  renderInitialTemplate(ID_MODULO, (response) => {
  })
}

// ------------------------------------------------------------------------------- SERVICES
function postEstados() {
  $.post(RUTA_GET_ESTADOS, (response) => {
    estados = JSON.parse(response);

    renderEstados(estados);
  });
}

// ------------------------------------------------------------------------------- EVENTOS
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
