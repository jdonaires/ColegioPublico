<?php
class Secciones
{

	private $Cod_Secciones;
	private $Descripcion;		
	private $Cod_Persona;		
	private $Cod_Turnos;		
	private $Cod_Fase;		
	private $Aforo;			
	private $RD_institucional;
	private $Fecha_Aprobacion;
	private $n_estudiantes;	
	private $Cod_grados;		


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