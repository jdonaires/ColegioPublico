<?php
class CursosGrados
{

	private $COD_CURSOS; 		
	private $COD_GRADOS;		
	private $OBSERVACION;		
	private $COD_PERIODOS; 	
	private $COD_ESCOLAR; 	
	private $COD_INSTITUCION;


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