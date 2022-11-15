const RUTA_CONTROLLER = "../controller/login.php?op=";

const RUTA_LOGIN = RUTA_CONTROLLER + "login";
const RUTA_SIGNUP = RUTA_CONTROLLER + "signup";

// ------------------------------------------------------------------------------------------ INICIACIÓN
function init() {
  //   Eventos
  submitLogin();
  submitSignup();
}

// ------------------------------------------------------------------------------------------ EVENTOS
function submitLogin() {
  const formularioId = "#form-login";
  $(formularioId).on("submit", function (event) {
    event.preventDefault();
    let formData = new FormData($(formularioId)[0]);
    const usuario = formData.get("login-privacy-policy");
    const correo = formData.get("login-email");
    const clave = formData.get("login-password");

    if (validarVacio(usuario)) return;
    if (validarVacio(clave)) return;
    if (!validarCorreo(correo)) return;
    if (clave.length < 4) return;

    doQueryAjax({
      event,
      peticion: formularioId, // nombre de id de formulario
      ruta: RUTA_LOGIN,
      onSubmit: (response) => {
        if (response) window.location = "principal";
        else setAlertError("Credenciales incorrectas");
      },
    });
  });
}

function submitSignup() {
  const formularioId = "#form-signup";
  $(formularioId).submit(function (event) {
    event.preventDefault();
    let formData = new FormData($(formularioId)[0]);
    const politicas = formData.get("register-privacy-policy");
    const usuario = formData.get("register-privacy-policy");
    const correo = formData.get("register-email");
    const clave = formData.get("register-password");

    if (validarVacio(usuario)) return;
    if (!validarCorreo(correo)) return;
    if (validarVacio(clave)) return;
    if (clave.length < 4) return;

    // if (politicas !== "on")
    //   return setAlertError("Acepte los términos y condiciones");

    console.log("Ingresó");
    return;
    doQueryAjax({
      event,
      peticion: formularioId,
      ruta: RUTA_SIGNUP,
      onSubmit: (response) => {
        if (response) window.location = "login";
        else setAlertError("Credenciales incorrectas");
      },
    });
  });
}

// ------------------------------------------------------------------------------------------ AJAX
function doQueryAjax({
  event,
  peticion,
  ruta,
  onSubmit,
  extra = null,
}) {
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
    success: function (response) {
      onSubmit(response);
    },
    error: function (error) {
      setAlertError("Error en servidor");
      console.log(error.responseText);
    },
  });
}

// ------------------------------------------------------------------------------------------ LLAMAR INICIO
init();

window.addEventListener("load", () => {
  console.log("Termino de cargarse");
});
