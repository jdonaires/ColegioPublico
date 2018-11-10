<?php
class Tipo_Ambientes
{
	private $cod_Tipoambiente;
	private $Descripcion;
	private $Estado

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
