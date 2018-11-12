<?php
class DetallesEvaluaciones
{
	private $calificacion;
	private $Cod_Evaluación;
	private $Cod_Matricula; 	


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