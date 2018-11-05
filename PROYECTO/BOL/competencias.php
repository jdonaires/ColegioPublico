<?php
class Competencias
{
	private $cod_capacidades;
	private $descripcion;
	private $justificacion;
	private $cod_cursos;

	public function __GET($x)
	{ 
		return $this->$x; 
	}
	public function __SET($x, $y)
	{ 
		return $this->$x = $y; 
	}
}
?>