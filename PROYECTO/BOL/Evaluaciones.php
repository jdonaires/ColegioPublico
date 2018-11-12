<?php
class Evaluaciones
{

	private $Cod_Evaluación;
	private $Promedio_final;
	private $Cod_Persona;
	private $Cod_Curso; 	
	private $Fecha; 		
	private $Hora;			
	private $Cod_Grados;			
	private $Cod_Periodos;			
	private $Cod_Escolar;			
	private $Cod_Institucion;	

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