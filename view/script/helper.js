// -----------------------------------------------------------------------  FORMULARIOS
const EXPRESIONES = {
  usuario: /^[a-zA-Z0-9\_\-]{4,16}$/, // Letras, numeros, guion y guion_bajo
  nombre: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
  password: /^.{4,12}$/, // 4 a 12 digitos.
  correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/,
  telefono: /^\d{7,14}$/, // 7 a 14 numeros.
};

const validarCorreo = (value) => {
  return EXPRESIONES.correo.test(value) ? true : false;
};

const validarVacio = (value) => {
  return value === "" ? true : false;
};

const limpiarFormulario = (idFormulario) => {
  $(idFormulario)[0].reset();
};

// ----------------------------------------------------------------------- ALERTAS FLOTANTES
function setAlertError(message = "Not message") {
  Swal.fire({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 5000,
    icon: "error",
    title: message,
  });

  //   toastr["error"](message, "💾 Task Action!", {
  //     closeButton: true,
  //     tapToDismiss: false,
  //     rtl: isRtl,
  //   });
}

function setAlertSuccess(message = "Not message") {
  Swal.fire({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 5000,
    icon: "success",
    title: message,
  });

  // toastr["success"](message, "💾 Task Action!", {
  //   closeButton: true,
  //   tapToDismiss: false,
  //   rtl: isRtl,
  // });
}

function setAlertWarning(message = "Not message") {
  Swal.fire({
    toast: true,
    position: "top-end",
    showConfirmButton: false,
    timer: 5000,
    icon: "warning",
    title: message,
  });
}

// ----------------------------------------------------------------------- STRINGS
function aCapitalizar(str) {
  return str.charAt(0).toUpperCase() + str.slice(1);
}
function quitarEspacios(str) {
  return str.replace(/\s+/g, "");
}

function obtenerEnlace() {
  let enlace = window.location.href;
  enlace = enlace.split("/");
  enlace = enlace[enlace.length - 1];

  return enlace;
}
