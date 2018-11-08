<?php
class Anio
{
	private $COD_ESCOLAR;
	private $ANIO_ESCOLAR;
	private $FECHA_INICIO;
	private $FECHA_FI;
	private $ESTADO;
	private $MODALIDAD_EVALUACION;
	private $N_PERSONALIE;
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
