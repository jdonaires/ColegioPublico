<?php
class Fases
{
	private $Cod_Fase;
	private $Cod_tipoFase;		
	private $Cod_Escolar; 		
	private $Fecha_Desde; 		
	private $Fecha_Hasta; 		
	private $Permitir_Asistencia;
	private $Estado; 			
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