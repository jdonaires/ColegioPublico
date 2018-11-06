<?php
class Grados
{
	private $Cod_Grados;
	private $Descripcion;
	private $N_secciones;
	private $N_cursos;
	private $Cod_DisenioC;

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