<?php
class Estudiantes
{
	private $cod_persona;
	private $n_hermanos;
	private $lugar_ocupa;
	private $religion;
	private $SAANEE;
	private $frecuencia_saanee;
	private $cod_discapacidad;
	private $cod_estudiante;

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
