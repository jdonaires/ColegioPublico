<?php
class TD_Personas
{

	private $Cod_Documento;	
	private $Numero_Identidad;


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