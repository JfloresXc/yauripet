<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class pry_usuario extends conexion
{
    public function __construct()
    {
    }

    public function signup($nombre, $usuario, $clave, $pregunta_secreta, $respuesta_secreta, $apellido_paterno, $apellido_materno)
    {
        $sql = "insert into usuario(nombre, usuario, clave, pregunta_secreta, respuesta_secreta, apellido_paterno, apellido_materno, estado) 
        values('$nombre', '$usuario', '$clave', '$pregunta_secreta', '$respuesta_secreta', '$apellido_paterno', '$apellido_materno', 1)";
        $response = $this->ejecutarConsulta($sql);
        return $response;
    }

    public function login($usuario, $clave)
    {
        $sql = "select  id, nombre, usuario FROM usuario WHERE usuario='$usuario' AND clave='$clave'";
        $response = $this->ejecutarConsulta($sql);
        return $response;
    }

    public function verifyUser($usuario)
    {
        $sql = "select id, nombre, usuario FROM usuario WHERE usuario='$usuario'";
        $response = $this->ejecutarConsulta($sql);
        return $response;
    }

    public function listarUsuarios()
    {
        $sql = "select * from usuario order by id";
        return $this->ejecutarConsulta($sql);
    }

    public function editarUsuario($idUsuario, $nombre, $usuario, $clave, $pregunta_secreta, $respuesta_secreta, $apellido_paterno, $apellido_materno)
    {
        $sql = "UPDATE from usuario where id = '$idUsuario' AND
        nombre = '$nombre' AND usuario = '$usuario' AND clave = '$clave' AND pregunta_secreta = '$pregunta_secreta' 
        AND respuesta_secreta = '$respuesta_secreta' AND apellido_paterno = '$apellido_paterno' 
        AND apellido_materno = '$apellido_materno'";
        return $this->ejecutarConsulta($sql);
    }

    public function eliminarUsuario($idUsuario)
    {
        $sql = "DELETE from usuario where id = '$idUsuario'";
        return $this->ejecutarConsulta($sql);
    }
}