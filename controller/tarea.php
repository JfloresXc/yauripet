<?php
require_once "../model/Tarea.php";
include('../config/Google.php');

ob_start();
if (strlen(session_id()) < 1) {
    session_start(); //Validamos si existe o no la sesión
}

$tarea = new pry_tarea();
$fechaHoy = date("Y-m-d");

$usuario = isset($_POST["usuario"]) ? $_POST["usuario"] : "";
$idUsuario = isset($_POST["idUsuario"]) ? $_POST["idUsuario"] : "";
$idProyecto = isset($_POST["idProyecto"]) ? $_POST["idProyecto"] : "";
$idProceso = isset($_POST["idProceso"]) ? $_POST["idProceso"] : "";
$idItem = isset($_POST["idItem"]) ? $_POST["idItem"] : "";
$idItemUltimo = isset($_POST["idItemUltimo"]) ? $_POST["idItemUltimo"] : "";
$idRol = isset($_POST["idRol"]) ? $_POST["idRol"] : "";
$idBloque = isset($_POST["idBloque"]) ? $_POST["idBloque"] : "";
$idTarea = isset($_POST["idTarea"]) ? $_POST["idTarea"] : "";

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
$nombreTarea = isset($_POST["nombre-tarea"]) ? $_POST["nombre-tarea"] : "";
$idProcesoTarea = isset($_POST["idProceso-tarea"]) ? $_POST["idProceso-tarea"] : "";
$idEstadoTarea = isset($_POST["idEstado-tarea"]) ? $_POST["idEstado-tarea"] : "";
$fechaIniTarea = isset($_POST["fechaIni-tarea"]) ? $_POST["fechaIni-tarea"] : "";
$fechaFinTarea = isset($_POST["fechaFin-tarea"]) ? $_POST["fechaFin-tarea"] : "";
$crucialTarea = isset($_POST["crucial-tarea"]) ? $_POST["crucial-tarea"] : "";
$tareaTarea = isset($_POST["tarea-tarea"]) ? $_POST["tarea-tarea"] : "";
$ordenTarea = isset($_POST["orden-tarea"]) ? $_POST["orden-tarea"] : "";
$listoTarea = isset($_POST["listo-tarea"]) ? $_POST["listo-tarea"] : "";
$tagsTarea = isset($_POST["tags-tarea"]) ? $_POST["tags-tarea"] : "";

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
        $response = $tarea->mostrarUsuario($usuario);
        echo json_encode($response);
        break;

    case 'listarProyectos':
        $response = $tarea->listarProyectos($usuario);
        $proyectos = [];

        while ($reg = pg_fetch_object($response)) {
            array_push($proyectos, $reg);
        }
        echo json_encode($proyectos);
        break;

    case 'agregarProyecto':
        $response = $tarea->agregarProyecto(
            $nombreProyecto,
            $descripcionProyecto,
            $fechaHoy,
            $fechaFinProyecto != '' ? $fechaFinProyecto : $fechaHoy,
            $cerradoProyecto
        );
        echo $response;
        break;

    case 'editarProyecto':
        $response = $tarea->editarProyecto(
            $idProyecto,
            $nombreProyecto,
            $descripcionProyecto,
            $fechaFinProyecto,
        );
        echo $response;
        break;

    case 'mostrarUltimoProyecto':
        $response = $tarea->mostrarUltimoProyecto();
        echo json_encode($response);
        break;

    case 'listarUsuariosPorProyecto':
        $response = $tarea->listarUsuariosPorProyecto($idProyecto);
        $usuarios = [];

        while ($reg = pg_fetch_object($response)) {
            array_push($usuarios, $reg);
        }
        echo json_encode($usuarios);
        break;

    case 'agregarEquipo':
        $responseEquipo = $tarea->agregarEquipo(
            $idProyecto,
            $idUsuario,
            $idRol,
        );
        // echo "$idProyecto, $codigoInvitacion, $idUsuario";
        echo $responseEquipo;
        break;

    case 'verificarUsuarioEquipo':
        $response = $tarea->verificarUsuarioEquipo(
            $idProyecto,
            $usuario
        );
        $usuariosEquipo = [];
        while ($reg = pg_fetch_object($response)) {
            array_push($usuariosEquipo, $reg);
        }
        echo json_encode($usuariosEquipo);
        break;

    case 'verificarInvitacion':
        $response = $tarea->verificarInvitacion($codigoInvitacion, $usuario);
        $invitacion = [];

        while ($reg = pg_fetch_object($response)) {
            array_push($invitacion, $reg);
        }

        echo json_encode($invitacion);
        break;

    case 'aceptarInvitacion':
        $responseInvitacion = $tarea->aceptarInvitacion(
            $codigoInvitacion
        );
        $responseEquipo = $tarea->agregarEquipo(
            $idProyecto,
            $idUsuario,
            2
        );
        // echo "$idProyecto, $codigoInvitacion, $idUsuario";
        echo $responseEquipo;
        break;

    case 'changeProyecto':
        $response = $tarea->changeProyecto($idProyecto);
        // Codificar el resultado utilizando json
        echo json_encode($response);
        break;

    case 'listarProcesos':
        $response = $tarea->listarProcesos($idProyecto);
        $procesos = [];

        while ($reg = pg_fetch_object($response)) {
            array_push($procesos, $reg);
        }
        echo json_encode($procesos);
        break;

    case 'agregarProceso':
        $response = $tarea->agregarProceso(
            $nombreProceso,
            $descripcionProceso,
            $idProyectoProceso
        );
        echo $response;
        break;

    case 'mostrarProceso':
        $response = $tarea->mostrarProceso($idProceso);
        // Codificar el resultado utilizando json
        echo json_encode($response);
        break;

    case 'editarProceso':
        $response = $tarea->editarProceso(
            $idProceso,
            $idProyectoProceso,
            $descripcionProceso,
            $nombreProceso,
        );
        echo $response;
        break;

    case 'listarTareas':
        $response = $tarea->listarBloques($idProyecto);
        $tareas = [];

        while ($reg = pg_fetch_object($response)) {
            array_push($tareas, $reg);
        }
        echo json_encode($tareas);
        break;

    case 'listarBloques':
        $response = $tarea->listarBloques($idProceso);
        $bloques = [];

        while ($reg = pg_fetch_object($response)) {
            array_push($bloques, $reg);
        }
        echo json_encode($bloques);
        break;

    case 'listarTagsTareasDeProyecto':
        $response = $tarea->listarTagsTareasDeProyecto($idProyecto);
        $tareas = [];

        while ($reg = pg_fetch_object($response)) {
            array_push($tareas, $reg);
        }
        echo json_encode($tareas);
        break;

    case 'listarBloquesUsuariosDeProyecto':
        $response = $tarea->listarBloquesUsuariosDeProyecto($idProyecto);
        $bloques = [];

        while ($reg = pg_fetch_object($response)) {
            array_push($bloques, $reg);
        }
        echo json_encode($bloques);
        break;

    case 'mostrarUltimoBloque':
        $response = $tarea->mostrarUltimoBloque();
        echo json_encode($response);
        break;

    case 'agregarBloque':
        $response = $tarea->agregarBloque(
            $nombreTarea,
            $idProcesoTarea,
            $idEstadoTarea,
            $fechaIniTarea,
            $fechaFinTarea != '' ? $fechaFinTarea : $fechaHoy,
            $ordenTarea,
            'on',
            $crucialTarea,
            $listoTarea
        );
        echo $response;
        break;

    case 'editarBloque':
        $response = $tarea->editarBloque(
            $idTarea,
            $nombreTarea,
            $idProcesoTarea,
            $idEstadoTarea,
            $fechaFinTarea,
            $crucialTarea,
            $listoTarea,
        );
        echo $response;
        break;

    case 'editarTareaEnBloque':
        $response = $tarea->editarTareaEnBloque(
            $idTarea,
            $tareaTarea,
        );
        echo $response;
        break;

    case 'editarListoEnBloque':
        $response = $tarea->editarListoEnBloque(
            $idTarea,
            $listoTarea,
        );
        echo $response;
        break;

    case 'agregarUsuarioBloque':
        $response = $tarea->agregarUsuarioBloque(
            $idBloque,
            $idUsuarioEnEquipo
        );
        echo $response;
        break;

    case 'verificarUsuarioBloque':
        $response = $tarea->verificarUsuarioBloque(
            $idBloque,
            $idUsuarioEnEquipo
        );
        $bloquesUsuarios = [];
        while ($reg = pg_fetch_object($response)) {
            array_push($bloquesUsuarios, $reg);
        }
        echo json_encode($bloquesUsuarios);
        break;

    case 'agregarBloqueTag':
        $tags = explode(",", $tagsTarea);

        $response = $tarea->agregarBloqueTag(
            $idBloque,
            $tags
        );
        echo $response;
        break;

    case 'eliminarBloqueTag':
        $response = $tarea->eliminarBloqueTag(
            $idBloque
        );
        echo $response;
        break;

    case 'listarTags':
        $response = $tarea->listarTags();
        $tags = [];

        while ($reg = pg_fetch_object($response)) {
            array_push($tags, $reg);
        }
        echo json_encode($tags);
        break;

    case 'listarEstados':
        $response = $tarea->listarEstados();
        $estados = [];

        while ($reg = pg_fetch_object($response)) {
            array_push($estados, $reg);
        }
        echo json_encode($estados);
        break;

    case 'listarItems':
        $response = $tarea->listarItems($idProyecto);
        $items = [];

        while ($reg = pg_fetch_object($response)) {
            array_push($items, $reg);
        }
        echo json_encode($items);
        break;

    case 'mostrarUltimoItem':
        $response = $tarea->mostrarUltimoItem();
        echo json_encode($response);
        break;

    case 'agregarItem':
        $response = $tarea->agregarItem(
            $idBloqueItem,
            1,
            $idUsuario,
            $ordenItem,
            $contenidoItem
        );
        echo $response;
        break;

    case 'editarItem':
        $response = $tarea->editarItem(
            $idItem,
            $idUsuario,
            $contenidoItem
        );
        echo $response;
        break;

    case 'editarItemOptions':
        $response = $tarea->editarItemOptions(
            $idItem,
            $tareaItem,
            $listoItem
        );
        echo $response;
        break;

    case 'eliminarItem':
        $response = $tarea->eliminarItem(
            $idItem
        );
        echo $response;
        break;

    case 'mostrarItem':
        $response = $tarea->mostrarItem($idItem);
        echo json_encode($response);
        break;

    case 'agregarImagen':
        $ruta_carpeta = "../public/img/";
        $ruta_guardar_archivo = $ruta_carpeta . basename($_FILES["imagen"]["name"]);
        $nombre_archivo = basename($_FILES["imagen"]["name"]);
        $fileError = $_FILES['imagen']['error'];

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        $fileExt = explode('.', $nombre_archivo);
        $fileActualExt = strtolower(end($fileExt));

        if (in_array($fileActualExt, $allowed)) {
            if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $ruta_guardar_archivo)) {
                echo $ordenItemImagen;
                $response = $tarea->agregarItem(
                    $idBloqueItemImagen,
                    2,
                    1,
                    $ordenItemImagen,
                    $ruta_guardar_archivo
                );

                echo "Imagen cargada";
            } else {
                echo "No se puede cargar";
            }
        } else {
            echo 'No se puede cargar ese tipo de archivo';
        }

    case 'listarManuales':
        $response = $tarea->listarManuales();
        $manuales = [];

        while ($reg = pg_fetch_object($response)) {
            array_push($manuales, $reg);
        }
        echo json_encode($manuales);
        break;

    case 'listarManualesItemsDeProyecto':
        $response = $tarea->listarManualesItemsDeProyecto($idProyecto);
        $bloques = [];

        while ($reg = pg_fetch_object($response)) {
            array_push($bloques, $reg);
        }
        echo json_encode($bloques);
        break;

    case 'agregarItemManual':
        $manuales = explode(",", $manualesItem);

        $response = $tarea->agregarItemManual(
            $idItem,
            $manuales
        );
        echo $response;
        break;

    case 'eliminarItemManual':
        $response = $tarea->eliminarItemManual(
            $idItem
        );
        echo $response;
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