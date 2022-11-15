


let USUARIO = "No hay usuario";
let ID_USUARIO;
let ID_MODULO = 2;

// ----------------------------------------- INICIACIÓN
function init() {
  //  Renderizados
  renderInitial();

  //   Eventos
}

// ----------------------------------------- RENDERIZADOS
function renderInitial() {
  renderInitialTemplate(ID_MODULO, (response) => {
    console.log(response)
  })
}

// ------------------------------------------------------------------------------- SERVICES

// ------------------------------------------------------------------------------- EVENTOS

// ------------------------------------ OBTENER USUARIO PARA PERMISOS

// ------------------------------------ LLAMAR INICIO
init();
