<?php
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

class pry_usuario extends conexion
{
    public function __construct()
    {
    }

    public function signup($nombre, $usuario, $clave)
    {
        $sql = "insert into usuario(nombre, usuario, clave) values('$nombre', '$usuario', '$clave')";
        $response = $this->ejecutarConsulta($sql);
        return $response;
    }

    public function verifyUser($usuario)
    {
        $sql = "select id, nombre, usuario FROM usuario WHERE usuario='$usuario'";
        $response = $this->ejecutarConsulta($sql);
        return $response;
    }

    public function login($usuario, $clave)
    {
        $sql = "select  id, nombre, usuario FROM usuario WHERE usuario='$usuario' AND clave='$clave'";
        $response = $this->ejecutarConsulta($sql);
        return $response;
    }
}