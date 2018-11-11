<?php
class Matricula
{

	private $Cod_Persona;
	private $Fecha_Matricula;
	private $Repetir_grado;
	private $Condicion_matricula;
	private $Situacion_matricula;
	private $Tipo_procedencia;
	private $Observaciones;
	private $Cod_Estudiante;
	private $Estado_Matricula;
	private $Descripcion_IE;
	private $Cod_Secciones;
	private $Cod_Grados;

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