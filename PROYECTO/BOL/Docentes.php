<?php
class Docentes
{

	private $Cargo;		 		
	private $Funcion;				
	private $Estado;				
	private $Nivel_Instruccion;	
	private $Carrera_Profesional; 
	private $Fecha_inicio;	    
	private $Fecha_Fin;			


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