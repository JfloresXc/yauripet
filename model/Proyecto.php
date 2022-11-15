<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class pry_proyecto extends conexion
{
	public function __construct()
	{
	}

	public function mostrarUsuario($usuario)
	{
		$sql = "select * from pry_usuario where usuario= '$usuario'";
		return $this->ejecutarConsultaSimpleFila($sql);
	}

	public function obtenerEquipo()
	{
		$sql = "select * from pry_equipo";
		return $this->ejecutarConsulta($sql);
	}

	public function verificarUsuarioEquipo($idProyecto, $usuario)
	{
		$sql = "SELECT * from pry_equipo eq, pry_usuario us
		where  eq.usuario = us.id and eq.proyecto = '$idProyecto' and us.usuario = '$usuario'";
		return $this->ejecutarConsulta($sql);
	}

	public function listarProyectos($usuario)
	{
		$sql = "select pp.id, pp.proyecto, pp.descripcion, pp.fechaini, pp.fechafin, pp.cerrado 
		from pry_proyecto pp, pry_equipo pe, pry_usuario pu 
		where pe.proyecto = pp.id and pe.usuario = pu.id and pu.usuario = '$usuario'";
		return $this->ejecutarConsulta($sql);
	}

	public function agregarProyecto($nombre, $descripcion, $fechaIni, $fechaFin, $cerrado)
	{
		$cerrado = $cerrado == 'on' ? 'true' : 'false';
		$sql = "INSERT into pry_proyecto(proyecto, descripcion, fechaini, fechafin, cerrado) 
		values('$nombre', '$descripcion', '$fechaIni', '$fechaFin', '$cerrado')";
		return $this->ejecutarConsulta($sql);
	}

	public function editarProyecto($idProyecto, $proyecto, $descripcion, $fechaFin)
	{
		$sql = "update pry_proyecto set proyecto = '$proyecto', descripcion = '$descripcion', fechafin = '$fechaFin' where id = '$idProyecto';";
		return $this->ejecutarConsulta($sql);
	}

	public function mostrarUltimoProyecto()
	{
		$sql = "select id FROM pry_proyecto ORDER BY id DESC LIMIT 1;";
		return $this->ejecutarConsultaSimpleFila($sql);
	}

	public function validarModuloUsuario($idUsuario, $idModulo)
	{
		$sql = "select up.idUsuario, up.idPermiso, p.idModulo, m.nombre, m.descripcion  
		from usuario_permiso up, permiso p, modulo m  
		where up.idPermiso = p.id and m.id = p.idModulo AND p.idModulo = '$idModulo' and up.idUsuario = '$idUsuario';";
		return $this->ejecutarConsultaSimpleFila($sql);
	}

	public function listarModulosUsuario($idUsuario)
	{
		$sql = "select up.idUsuario, up.idPermiso, p.idModulo, m.nombre, m.descripcion  
		from usuario_permiso up, permiso p, modulo m  
		where up.idPermiso = p.id and m.id = p.idModulo AND up.idUsuario = '$idUsuario';";
		return $this->ejecutarConsulta($sql);
	}
}