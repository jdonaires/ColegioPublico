<?php
class Curso_Matricula
{
	private $Cod_Matricula;
	private $Cod_Persona;
	private $Cod_Cursos;

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