<?php
class Disenio
{
	private $Cod_DisenioC;
	private $Descripcion;
	private $Anio;
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