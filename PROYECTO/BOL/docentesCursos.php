<?php
class docentesCursos
{

	private $Cod_Persona;		
	private $Cod_Curso;			

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