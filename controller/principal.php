<?php
require_once "../model/Proyecto.php";

ob_start();
if (strlen(session_id()) < 1) {
    session_start(); //Validamos si existe o no la sesión
}

$fechaHoy = date("Y-m-d");
$proyecto = new pry_proyecto();
$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
$idUsuario = isset($_POST["idUsuario"]) ? $_POST["idUsuario"] : "";
$idModulo = isset($_POST["idModulo"]) ? $_POST["idModulo"] : "";
$idProyecto = isset($_POST["idProyecto"]) ? $_POST["idProyecto"] : "";
$idProceso = isset($_POST["idProceso"]) ? $_POST["idProceso"] : "";
$idItem = isset($_POST["idItem"]) ? $_POST["idItem"] : "";
$idItemUltimo = isset($_POST["idItemUltimo"]) ? $_POST["idItemUltimo"] : "";
$idRol = isset($_POST["idRol"]) ? $_POST["idRol"] : "";
$idBloque = isset($_POST["idBloque"]) ? $_POST["idBloque"] : "";

// AGREGAR PROYECTO
$nombreProyecto = isset($_POST["nombre-proyecto"]) ? $_POST["nombre-proyecto"] : "";
$descripcionProyecto = isset($_POST["descripcion-proyecto"]) ? $_POST["descripcion-proyecto"] : "";
$fechaFinProyecto = isset($_POST["fechaFin-proyecto"]) ? $_POST["fechaFin-proyecto"] : "";
$cerradoProyecto = isset($_POST["cerrado-proyecto"]) ? $_POST["cerrado-proyecto"] : "";

// AGREGAR INVITACION
$codigoInvitacion = isset($_POST["codigoInvitacion"]) ? $_POST["codigoInvitacion"] : "";

// AGREGAR PROCESO
$nombreProceso = isset($_POST["nombre-proceso"]) ? $_POST["nombre-proceso"] : "";
$descripcionProceso = isset($_POST["descripcion-proceso"]) ? $_POST["descripcion-proceso"] : "";
$idProyectoProceso = isset($_POST["idProyecto-proceso"]) ? $_POST["idProyecto-proceso"] : "";

// AGREGAR BLOQUE
$nombreBloque = isset($_POST["nombre-bloque"]) ? $_POST["nombre-bloque"] : "";
$idProcesoBloque = isset($_POST["idProceso-bloque"]) ? $_POST["idProceso-bloque"] : "";
$idEstadoBloque = isset($_POST["idEstado-bloque"]) ? $_POST["idEstado-bloque"] : "";
$fechaIniBloque = isset($_POST["fechaIni-bloque"]) ? $_POST["fechaIni-bloque"] : "";
$fechaFinBloque = isset($_POST["fechaFin-bloque"]) ? $_POST["fechaFin-bloque"] : "";
$crucialBloque = isset($_POST["crucial-bloque"]) ? $_POST["crucial-bloque"] : "";
$tareaBloque = isset($_POST["tarea-bloque"]) ? $_POST["tarea-bloque"] : "";
$ordenbloque = isset($_POST["orden-bloque"]) ? $_POST["orden-bloque"] : "";
$tagsBloque = isset($_POST["tags-bloque"]) ? $_POST["tags-bloque"] : "";

// AGREGAR ITEM
$idBloqueItemTexto = isset($_POST["idBloque-item-texto"]) ? $_POST["idBloque-item-texto"] : "";
$contenidoItemTexto = isset($_POST["contenido-item-texto"]) ? $_POST["contenido-item-texto"] : "";
$ordenItemTexto = isset($_POST["orden-item-texto"]) ? $_POST["orden-item-texto"] : "";
$idBloqueItem = isset($_POST["idBloque-item"]) ? $_POST["idBloque-item"] : "";
$contenidoItem = isset($_POST["contenido-item"]) ? $_POST["contenido-item"] : "";
$ordenItem = isset($_POST["orden-item"]) ? $_POST["orden-item"] : "";
$tareaItem = isset($_POST["tarea-item"]) ? $_POST["tarea-item"] : "";
$listoItem = isset($_POST["listo-item"]) ? $_POST["listo-item"] : "";
$manualesItem = isset($_POST["manuales-item"]) ? $_POST["manuales-item"] : "";

// OBTENER ITEM IMAGE
$idBloqueItemImagen = isset($_POST["idBloque-item-imagen"]) ? $_POST["idBloque-item-imagen"] : "";
$ordenItemImagen = isset($_POST["orden-item-imagen"]) ? $_POST["orden-item-imagen"] : "";

// OBTENER BLOQUE USUARIO
$idUsuarioEnEquipo = isset($_POST["idUsuario-bloque"]) ? $_POST["idUsuario-bloque"] : "";

switch ($_GET["op"]) {
    case 'mostrarUsuario':
        $response = $proyecto->mostrarUsuario($usuario);
        echo json_encode($response);
        break;

    case 'listarProyectos':
        $response = $proyecto->listarProyectos($usuario);
        $proyectos = [];

        while ($reg = pg_fetch_object($response)) {
            array_push($proyectos, $reg);
        }
        echo json_encode($proyectos);
        break;

    case 'agregarProyecto':
        $response = $proyecto->agregarProyecto(
            $nombreProyecto,
            $descripcionProyecto,
            $fechaHoy,
            $fechaFinProyecto != '' ? $fechaFinProyecto : $fechaHoy,
            $cerradoProyecto
        );
        echo $response;
        break;

    case 'editarProyecto':
        $response = $proyecto->editarProyecto(
            $idProyecto,
            $nombreProyecto,
            $descripcionProyecto,
            $fechaFinProyecto != '' ? $fechaFinProyecto : $fechaHoy,
        );
        echo $response;
        break;

    case 'mostrarUltimoProyecto':
        $response = $proyecto->mostrarUltimoProyecto();
        echo json_encode($response);
        break;

    case 'listarModulosUsuario':
        $response = $proyecto->listarModulosUsuario($idUsuario);
        $proyectos = [];

        while ($reg = mysqli_fetch_object($response)) {
            array_push($proyectos, $reg);
        }
        echo json_encode($proyectos);
        break;

    case 'validarModuloUsuario':
        $response = $proyecto->validarModuloUsuario($idUsuario, $idModulo);
        echo json_encode($response);
        break;


    case 'logout':
        //Reset OAuth access token
        $google_client->revokeToken();

        session_unset();
        session_destroy();

        $estado = true;
        echo $estado;
        break;

    case 'mostrarSesionUsuario':
        if (isset($_SESSION["usuario"])) {
            $usuarioSesion = array(
                $_SESSION["usuario"],
                $_SESSION["nombre"],
                $_SESSION['id_usuario']
            );

            echo json_encode($usuarioSesion);
            break;
        }
        echo 'No hay usuario';
        break;

    case 'mostrarSesionInvitacion':
        if (isset($_SESSION['invitacion'])) {
            echo $_SESSION['invitacion'];
            break;
        }
        echo 'No hay invitacion';
        break;
}

ob_end_flush();