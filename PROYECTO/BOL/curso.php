<?php
class Curso
{
	private $cod_curso;
	private $descripcion;
	private $n_capacidades;

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