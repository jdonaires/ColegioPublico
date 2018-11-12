<?php
class Ambientes
{
	private $COD_AMBIENTE;
	private $COD_TIPOAMBIENTE;
	private $DESCRIPCION; 	
	private $UBICACION; 		
	private $AFORO;			
	private $AREA;			
	private $ESTADO;			
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