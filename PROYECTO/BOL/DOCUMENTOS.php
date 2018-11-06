<?php
class DOCUMENTOS
{
	private $cod_Tipodocumento;
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
