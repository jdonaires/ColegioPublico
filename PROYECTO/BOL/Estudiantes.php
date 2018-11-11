<?php
class Estudiantes
{

	private $N_Hermanos;		 		
	private $Lugar_Ocupa;				
	private $Religion;				
	private $saanee;	
	private $Frecuencia_saanee; 
	private $Cod_Discapacidad;	    
	private $Cod_Estudiante;			


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