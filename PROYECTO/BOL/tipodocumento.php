<?php
class TipoDocumento
{
	private $Cod_Documento;
	private $Descripcion;

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