<?php
class Periodos
{

	private $N_Descripcion;		
	private $Anio_Escolar;		
	private $Cod_Tipo;			
	private $Descripcion_periodo;	
	private $Fecha_inicio;		
	private $Fecha_Fin;			
	private $Estado;				
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