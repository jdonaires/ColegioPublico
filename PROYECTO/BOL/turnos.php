<?php
class Turnos
{
	private $cod_Turnos;
	private $descripcion;

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