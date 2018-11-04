<?php
class Tipos_IE
{

	private $cod_tipoie;  
	private $descripcion;       
	private $estado;                      

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