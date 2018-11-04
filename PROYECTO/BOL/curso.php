<?php
class Curso
{
	private $cod_curso;
	private $descripcion;
	private $n_capacidades;
	private $estado;

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