<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class pry_tarea
{
    public function __construct()
    {
    }

    public function mostrarUsuario($usuario)
    {
        $sql = "SELECT * from pry_usuario where usuario= '$usuario'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function obtenerEquipo()
    {
        $sql = "SELECT * from pry_equipo";
        return ejecutarConsulta($sql);
    }

    public function verificarUsuarioEquipo($idProyecto, $usuario)
    {
        $sql = "SELECT * from pry_equipo eq, pry_usuario us
		where  eq.usuario = us.id and eq.proyecto = '$idProyecto' and us.usuario = '$usuario'";
        return ejecutarConsulta($sql);
    }

    public function listarProyectos($usuario)
    {
        $sql = "SELECT pp.id, pp.proyecto, pp.descripcion, pp.fechaini, pp.fechafin, pp.cerrado 
		from pry_proyecto pp, pry_equipo pe, pry_usuario pu 
		where pe.proyecto = pp.id and pe.usuario = pu.id and pu.usuario = '$usuario'";
        return ejecutarConsulta($sql);
    }

    public function agregarProyecto($nombre, $descripcion, $fechaIni, $fechaFin, $cerrado)
    {
        $cerrado = $cerrado == 'on' ? 'true' : 'false';
        $sql = "INSERT into pry_proyecto(proyecto, descripcion, fechaini, fechafin, cerrado) 
		values('$nombre', '$descripcion', '$fechaIni', '$fechaFin', '$cerrado')";
        return ejecutarConsulta($sql);
    }

    public function editarProyecto($idProyecto, $proyecto, $descripcion, $fechaFin)
    {
        $sql = "update pry_proyecto set proyecto = '$proyecto', descripcion = '$descripcion', fechafin = '$fechaFin' where id = '$idProyecto';";
        return ejecutarConsulta($sql);
    }

    public function mostrarUltimoProyecto()
    {
        $sql = "SELECT id FROM pry_proyecto ORDER BY id DESC LIMIT 1;";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listarUsuariosPorProyecto($idProyecto)
    {
        $sql = "SELECT pu.id, pu.nombre, pu.usuario, rl.rol
		from pry_proyecto pp, pry_equipo pe, pry_usuario pu, pry_rol rl  
		where rl.id = pe.rol and pe.usuario = pu.id and pe.proyecto = pp.id and pp.id = '$idProyecto'";
        return ejecutarConsulta($sql);
    }
    public function listarTagPorProyecto($idProyecto)
    {
        $sql = "SELECT pb.id, pb.bloque, pt.tag, pt.id 
		FROM pry_tag pt, pry_proyecto pp, pry_proceso pp2, pry_bloque_tag pbt, pry_bloque pb 
		where pp.id = '$idProyecto' and pp.id = pp2.proyecto and pp2.id = pb.proceso and pb.id = pbt.bloque and pb.tarea = true and pt.id = pbt.tag;";
        return ejecutarConsulta($sql);
    }

    public function agregarEquipo($idProyecto, $idUsuario, $rol)
    {
        $sql = "insert into pry_equipo(proyecto, usuario, rol) 
		values('$idProyecto', '$idUsuario', '$rol')";
        return ejecutarConsulta($sql);
    }

    public function agregarInvitacion($url, $estado, $idProyecto, $usuarioPropietario, $usuarioDestinatario, $codigo)
    {
        $sql = "insert into pry_invitacion(url, estado, proyecto, usuario_propietario, usuario_destinatario, codigo) 
		values('$url', '$estado', '$idProyecto', '$usuarioPropietario', '$usuarioDestinatario', '$codigo')";
        return ejecutarConsulta($sql);
    }

    public function verificarInvitacion($codigo, $usuarioDestinatario)
    {
        $sql = "SELECT * from pry_invitacion where usuario_destinatario= '$usuarioDestinatario' and codigo = '$codigo' and estado = 'inactivo'";
        return ejecutarConsulta($sql);
    }

    public function aceptarInvitacion($codigoInvitacion)
    {
        $sql = "update pry_invitacion 
		set estado = 'activo'
		where codigo = '$codigoInvitacion'";
        return ejecutarConsulta($sql);
    }

    public function changeProyecto($idProyecto)
    {
        $sql = "SELECT * from pry_proyecto where id='$idProyecto'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listarProcesos($idProyecto)
    {
        $sql = "SELECT * from pry_proceso where proyecto='$idProyecto' order by id desc";
        return ejecutarConsulta($sql);
    }

    public function agregarProceso($nombre, $descripcion, $idProyecto)
    {
        $sql = "insert into pry_proceso(proceso, descripcion, proyecto) values('$nombre', '$descripcion', '$idProyecto')";
        return ejecutarConsulta($sql);
    }

    public function editarProceso($idProceso, $proyecto, $descripcion, $proceso)
    {
        $sql = "update pry_proceso set proyecto = '$proyecto', descripcion = '$descripcion', proceso = '$proceso' where id = '$idProceso';";
        return ejecutarConsulta($sql);
    }

    public function mostrarProceso($idProceso)
    {
        $sql = "SELECT * from pry_proceso where id= '$idProceso'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listarBloques($idProyecto)
    {
        $sql = "SELECT prc.id, prc.proceso, prc.bloque, prc.orden, prc.crucial, prc.tarea, prc.listo, prc.fechafin, prc.fechaini, prc.estado    
        from pry_bloque prc, pry_proceso pp 
        WHERE prc.tarea = true AND prc.proceso = pp.id AND pp.proyecto = '$idProyecto' 
        order by prc.id desc;";
        return ejecutarConsulta($sql);
    }

    public function mostrarUltimoBloque()
    {
        $sql = "SELECT id FROM pry_bloque ORDER BY id DESC LIMIT 1;";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function agregarBloque($nombre, $idProceso, $idEstado, $fechaIni, $fechaFin, $orden, $tarea, $crucial, $listo)
    {
        $crucial = $crucial == 'on' ? 'true' : 'false';
        $tarea = $tarea == 'on' ? 'true' : 'false';
        $listo = $listo == 'on' ? 'true' : 'false';
        $sql = "INSERT into pry_bloque(bloque, proceso, estado, fechaini, fechafin, orden, tarea, crucial, listo) 
		values('$nombre', '$idProceso', '$idEstado', '$fechaIni', '$fechaFin', '$orden', '$tarea', '$crucial', '$listo')";
        return ejecutarConsulta($sql);
    }

    public function editarBloque($idBloque, $nombre, $idProceso, $idEstado, $fechaFin, $crucial, $listo)
    {
        $crucial = $crucial == 'on' ? 'true' : 'false';
        $listo = $listo == 'on' ? 'true' : 'false';
        $sql = "UPDATE pry_bloque 
        set bloque = '$nombre',  proceso = '$idProceso',  estado = '$idEstado',  fechaFin = '$fechaFin',  crucial = '$crucial',  listo = '$listo' 
        where id = '$idBloque'";
        return ejecutarConsulta($sql);
    }

    public function editarTareaEnBloque($idBloque, $tarea)
    {
        $tarea = $tarea == 'on' ? 'true' : 'false';
        $sql = "UPDATE pry_bloque 
        set tarea = '$tarea' 
        where id = '$idBloque'";
        return ejecutarConsulta($sql);
    }

    public function editarListoEnBloque($idBloque, $listo)
    {
        $listo = $listo == 'on' ? 'true' : 'false';
        $sql = "UPDATE pry_bloque 
        set listo = '$listo' 
        where id = '$idBloque'";
        return ejecutarConsulta($sql);
    }

    public function listarEquipoBloque()
    {
        $sql = "SELECT * FROM pry_bloque_user where bloque = ;";
        return ejecutarConsulta($sql);
    }

    public function listarTagsTareasDeProyecto($idProyecto)
    {
        $sql = "SELECT pb.id, pb.bloque, pt.tag  
        FROM pry_tag pt, pry_proyecto pp, pry_proceso pp2, pry_bloque_tag pbt, pry_bloque pb 
        where pp.id = $idProyecto and pp.id = pp2.proyecto and pp2.id = pb.proceso and pb.id = pbt.bloque and pb.tarea = true and pt.id = pbt.tag;";
        return ejecutarConsulta($sql);
    }

    public function listarBloquesUsuariosDeProyecto($idProyecto)
    {
        $sql = "SELECT pb.id, pb.bloque, pbu.usuario, pu.nombre FROM pry_usuario pu, pry_proyecto pp, pry_proceso pp2, pry_bloque_user pbu, pry_bloque pb 
		where pp.id = '$idProyecto' and pp.id = pp2.proyecto and pp2.id = pb.proceso and pb.id = pbu.bloque and pu.id = pbu.usuario;";
        return ejecutarConsulta($sql);
    }

    public function listarBloquesTag($idProyecto)
    {
        $sql = "SELECT pb.id, pb.bloque, pbu.usuario, pu.nombre FROM pry_usuario pu, pry_proyecto pp, pry_proceso pp2, pry_bloque_user pbu, pry_bloque pb 
		where pp.id = '$idProyecto' and pp.id = pp2.proyecto and pp2.id = pb.proceso and pb.id = pbu.bloque and pu.id = pbu.usuario;";
        return ejecutarConsulta($sql);
    }

    public function agregarUsuarioBloque($idBloque, $idUsuario)
    {
        $sql = "insert into pry_bloque_user(bloque, usuario) 
		values('$idBloque', '$idUsuario')";
        return ejecutarConsulta($sql);
    }

    public function verificarUsuarioBloque($idBloque, $idUsuario)
    {
        $sql = "SELECT * from pry_bloque_user 
		where bloque = '$idBloque' and usuario = '$idUsuario'";
        return ejecutarConsulta($sql);
    }

    public function agregarBloqueTag($idBloque, $tags  = [])
    {
        $valueQuery = "";
        foreach ($tags as &$tagKey) {
            if ($tags[0] == $tagKey) {
                $valueQuery = "('$idBloque', '$tagKey')";
            } else {
                $valueQuery = "$valueQuery, ('$idBloque', '$tagKey')";
            }
        }
        $sql = "INSERT INTO pry_bloque_tag(bloque, tag) VALUES $valueQuery";
        return ejecutarConsulta($sql);
    }

    public function eliminarBloqueTag($idBloque)
    {
        $sql = "DELETE FROM pry_bloque_tag pbt
        WHERE pbt.bloque = '$idBloque'";
        return ejecutarConsulta($sql);
    }

    public function listarTags()
    {
        $sql = "SELECT * from pry_tag";
        return ejecutarConsulta($sql);
    }

    public function listarEstados()
    {
        $sql = "SELECT * from pry_estado";
        return ejecutarConsulta($sql);
    }

    public function listarItems($idProyecto)
    {
        $sql = "SELECT i.id, i.bloque, i.tipo, i.usuario, i.orden, i.contenido, i.listo, i.tarea  
			FROM  pry_bloque b, pry_itm i, pry_proceso pc
            WHERE pc.proyecto = '$idProyecto' AND pc.id = b.proceso AND b.id = i.bloque
			ORDER BY i.id desc;
		";
        return ejecutarConsulta($sql);
    }

    public function mostrarItem($idItem)
    {
        $sql = "SELECT * from pry_itm where id= '$idItem'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function mostrarUltimoItem()
    {
        $sql = "SELECT id FROM pry_itm ORDER BY id DESC LIMIT 1;";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function agregarItem($bloque, $tipo, $usuario, $orden, $contenido)
    {
        $sql = "insert into pry_itm(bloque, tipo, usuario, orden, contenido) 
        values('$bloque', '$tipo', '$usuario', '$orden', '$contenido');";
        return ejecutarConsulta($sql);
    }

    public function editarItem($idItem, $usuario, $contenido)
    {
        $sql = "update pry_itm set  usuario = '$usuario', contenido = '$contenido' where id = '$idItem';";
        return ejecutarConsulta($sql);
    }

    public function editarItemOptions($idItem, $tarea, $listo)
    {
        $tarea = $tarea == 'on' ? 'true' : 'false';
        $listo = $listo == 'on' ? 'true' : 'false';
        $sql = "update pry_itm set tarea = '$tarea', listo = '$listo' where id = '$idItem';";
        return ejecutarConsulta($sql);
    }

    public function eliminarItem($idItem)
    {
        $sql = "delete from pry_itm where id= '$idItem'";
        return ejecutarConsultaSimpleFila($sql);
    }

    public function listarManuales()
    {
        $sql = "SELECT * from pry_manual;";
        return ejecutarConsulta($sql);
    }

    public function listarManualesItemsDeProyecto($idProyecto)
    {
        $sql = "SELECT pi2.id, pi2.contenido, pim.manual 
		from pry_manual pm, pry_proyecto pp, pry_proceso pp2, pry_itm_manual pim, pry_itm pi2, pry_bloque pb 
		where pp.id = '$idProyecto' and pp.id = pp2.proyecto and pp2.id = pb.proceso and pb.id = pi2.bloque and pi2.id = pim.itm and pm.id = pim.manual;";
        return ejecutarConsulta($sql);
    }

    public function listarItemsManual()
    {
        $sql = "
			SELECT * from pry_itm_manual;
		";
        return ejecutarConsulta($sql);
    }

    public function agregarItemManual($idItem, $manuales  = [])
    {
        $valueQuery = "";
        foreach ($manuales as &$manualKey) {
            if ($manuales[0] == $manualKey) {
                $valueQuery = "('$idItem', '$manualKey')";
            } else {
                $valueQuery = "$valueQuery, ('$idItem', '$manualKey')";
            }
        }
        $sql = "INSERT INTO pry_itm_manual(itm, manual) VALUES $valueQuery";
        return ejecutarConsulta($sql);
    }

    public function eliminarItemManual($idItem)
    {
        $sql = "DELETE FROM pry_itm_manual pim
        WHERE pim.itm = '$idItem'";
        return ejecutarConsulta($sql);
    }
}