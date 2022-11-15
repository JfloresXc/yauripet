<?php

class conexion
{
	protected function conectar()
	{
		$conn = mysqli_connect("localhost", "root", "", "yauripet");
		return $conn;
	}

	protected function desconectar($conectados)
	{
		mysqli_close($conectados);
	}

	function ejecutarConsulta($sql)
	{
		$result = mysqli_query($this->conectar(), $sql);
		return $result;
	}

	function ejecutarConsultaSimpleFila($sql)
	{
		$query = mysqli_query($this->conectar(), $sql);
		$row =  mysqli_fetch_assoc($query);


		return $row;
	}

	function ejecutarConsulta_retornarID($sql)
	{
		$query = mysqli_query($this->conectar(), $sql);
		$resultados = mysqli_fetch_array($query);
		return $resultados[0];
	}

	function limpiarCadena($str)
	{
		$str = mysqli_escape_string($this->conectar(), trim($str));
		return htmlspecialchars($str);
	}
}